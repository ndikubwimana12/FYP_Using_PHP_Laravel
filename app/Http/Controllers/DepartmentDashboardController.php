<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\Department;
use App\Models\Supervision;
use Barryvdh\DomPDF\Facade\Pdf;

class DepartmentDashboardController extends Controller
{
    public function index()
    {
        $projects = Project::with(['student'])->latest()->get();
        $students = Student::all();
        $supervisors = Supervisor::all();

        // Calculate counts using correct supervision table structure
        foreach ($supervisors as $supervisor) {
            $supervisor->projects_count = Supervision::where('supervisor_id', $supervisor->id)
                ->count();
            $supervisor->students_count = Supervision::where('supervisor_id', $supervisor->id)
                ->distinct('StudentRegNumber')
                ->count();
        }

        // Statistics
        $totalProjects = $projects->count();
        $activeProjects = $projects->where('status', 'active')->count();
        $completedProjects = $projects->where('status', 'completed')->count();
        $pendingApprovals = $projects->where('status', 'pending')->count();

        return view('department.dashboard', compact(
            'projects',
            'students',
            'supervisors',
            'totalProjects',
            'activeProjects',
            'completedProjects',
            'pendingApprovals'
        ));
    }





    public function supervisors()
    {
        $supervisors = Supervisor::all();
        foreach ($supervisors as $supervisor) {
            $supervisor->projects_count = Project::whereHas('supervision', function ($query) use ($supervisor) {
                $query->where('supervisor_id', $supervisor->id);
            })->count();

            $supervisor->students_count = Supervision::where('supervisor_id', $supervisor->id)
                ->distinct('StudentRegNumber')
                ->count();
        }
        return view('department.supervisors', compact('supervisors'));
    }



    public function students()
    {
        $students = Student::with('project')->get();
        return view('department.students', compact('students'));
    }

    public function projects()
    {
        $projects = Project::with(['student', 'supervisor'])->get();
        return view('department.projects', compact('projects'));
    }

    public function reports()
    {
        $projectStats = Project::selectRaw('ProjectCode as status, count(*) as count')
            ->groupBy('ProjectCode')
            ->get();

        $projects = Project::all();

        // Get supervisors with project counting through supervisions
        $supervisors = Supervisor::all();
        foreach ($supervisors as $supervisor) {
            $supervisor->projects_count = Project::whereHas('supervision', function ($query) use ($supervisor) {
                $query->where('supervisor_id', $supervisor->id);
            })->count();
        }

        return view('department.reports', compact('projectStats', 'projects', 'supervisors'));
    }


    public function assignSupervisorView()
    {
        $unassignedStudents = Student::whereNotIn('StudentRegNumber', function ($query) {
            $query->select('StudentRegNumber')->from('supervisions');
        })->get();

        // Get all supervisors with ID
        $supervisors = Supervisor::select('id', 'SupervisorFirstName', 'SupervisorLastName')->get();

        // Count supervisions using supervisor id
        foreach ($supervisors as $supervisor) {
            $supervisor->projects_count = Supervision::where('supervisor_id', $supervisor->id)
                ->where('status', 'active')
                ->count();
        }

        $totalAssignments = Supervision::where('status', 'active')->count();

        return view('department.assign-supervisors', compact('unassignedStudents', 'supervisors', 'totalAssignments'));
    }

    public function assignSupervisor(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'supervisor_id' => 'required',
            'student_id' => 'required'
        ]);

        // Create new supervision assignment
        Supervision::create([
            'supervisor_id' => $validated['supervisor_id'],
            'StudentRegNumber' => $validated['student_id'],
            'status' => 'active'
        ]);

        return redirect()->back()->with('success', 'Supervisor assigned successfully');
    }
    public function generateReport(Request $request)
    {
        $validated = $request->validate([
            'date_range' => 'required',
            'report_type' => 'required',
            'format' => 'required'
        ]);

        // Get the date range
        $days = $validated['date_range'];
        $startDate = now()->subDays($days);

        // Get data based on report type
        switch ($validated['report_type']) {
            case 'project_status':
                $data = Project::where('created_at', '>=', $startDate)
                    ->selectRaw('status, count(*) as count')
                    ->groupBy('status')
                    ->get();
                break;

            case 'supervisor_workload':
                $data = Supervisor::withCount(['supervisions' => function ($query) use ($startDate) {
                    $query->where('created_at', '>=', $startDate);
                }])->get();
                break;

            case 'student_progress':
                $data = Student::with(['project' => function ($query) use ($startDate) {
                    $query->where('created_at', '>=', $startDate);
                }])->get();
                break;

            default:
                $data = Project::where('created_at', '>=', $startDate)->get();
        }

        // Generate report based on format
        switch ($validated['format']) {
            case 'PDF':
                return PDF::loadView('department.reports.pdf', compact('data'))
                    ->download('report.pdf');
            case 'Excel':
                return Excel::download(new ReportExport($data), 'report.xlsx');
            case 'CSV':
                return (new ReportExport($data))->download('report.csv');
        }
    }
}
