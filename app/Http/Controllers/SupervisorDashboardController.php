<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Student;
use App\Models\Supervision;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class SupervisorDashboardController extends Controller
{
    public function index()
{
    // Get all supervisions for this supervisor
    $supervisions = Supervision::where('supervisor_id', auth()->id())
        ->with(['student'])
        ->get();

    // Get all student registration numbers under this supervisor
    $studentRegNumbers = $supervisions->pluck('StudentRegNumber');

    // Get all projects from supervised students
    $projects = Project::whereIn('StudentRegNumber', $studentRegNumbers)
        ->with(['student'])
        ->orderBy('created_at', 'desc')
        ->get();

    $activeSupervisions = $supervisions->where('status', 'active')->count();
    $completedSupervisions = $supervisions->where('status', 'completed')->count();

    return view('supervisor.dashboard', compact('projects', 'supervisions', 'activeSupervisions', 'completedSupervisions'));
}

    public function students()
    {
        $students = Student::whereHas('supervision', function ($query) {
            $query->where('supervisor_id', auth()->id());
        })->with(['project', 'supervision'])->get();

        return view('supervisor.students', compact('students'));
    }

    public function projects()
    {
        $projects = Project::whereHas('student.supervision', function ($query) {
            $query->where('supervisor_id', auth()->id());
        })->with(['student'])->get();

        return view('supervisor.projects', compact('projects'));
    }

    public function viewProject($code)
    {
        $project = Project::where('ProjectCode', $code)
            ->whereHas('student.supervision', function ($query) {
                $query->where('supervisor_id', auth()->id());
            })
            ->with(['student'])
            ->firstOrFail();

        return view('supervisor.project-details', compact('project'));
    }

    public function reports()
    {
        $students = Student::whereHas('supervision', function ($query) {
            $query->where('supervisor_id', auth()->id());
        })->get();

        return view('supervisor.reports', compact('students'));
    }

    public function profile()
    {
        $supervisor = auth()->user();
        return view('supervisor.profile', compact('supervisor'));
    }

    public function generateReport(Request $request)
    {
        $validated = $request->validate([
            'report_type' => 'required',
            'date_range' => 'required',
            'format' => 'required'
        ]);

        $students = Student::whereHas('supervision', function ($query) {
            $query->where('supervisor_id', auth()->id());
        })->with(['project'])->get();

        $data = [
            'students' => $students,
            'report_type' => $validated['report_type'],
            'date_range' => $validated['date_range'],
            'generated_at' => now()
        ];

        if ($validated['format'] === 'PDF') {
            $pdf = PDF::loadView('supervisor.reports.pdf', $data);
            return $pdf->download('supervisor-report.pdf');
        }

        if ($validated['format'] === 'Excel') {
            return Excel::download(new SupervisorReportExport($data), 'supervisor-report.xlsx');
        }

        return response()->json($data);
    }
    public function pendingProjects()
    {
        $projects = Project::whereHas('student.supervision', function ($query) {
            $query->where('supervisor_id', auth()->id())
                ->where('status', 'active');
        })
            ->where('status', 'pending')
            ->with(['student'])
            ->get();

        return view('supervisor.pending-projects', compact('projects'));
    }

    public function approveProject($projectCode)
{
    $project = Project::where('ProjectCode', $projectCode)
        ->whereHas('student.supervision', function ($query) {
            $query->where('supervisor_id', auth()->id());
        })
        ->firstOrFail();

    $project->update([
        'status' => 'approved',
        'approved_at' => now()
    ]);

    // Send notification to student
    $project->student->notify(new ProjectApproved($project));

    return redirect()->back()->with('success', 'Project approved successfully');
}

public function rejectProject(Request $request, $projectCode)
{
    $validated = $request->validate([
        'reason' => 'required|string|min:10'
    ]);

    $project = Project::where('ProjectCode', $projectCode)
        ->whereHas('student.supervision', function ($query) {
            $query->where('supervisor_id', auth()->id());
        })
        ->firstOrFail();

    $project->update([
        'status' => 'rejected',
        'rejection_reason' => $validated['reason'],
        'rejected_at' => now()
    ]);

    // Send notification to student
    $project->student->notify(new ProjectRejected($project));

    return redirect()->back()->with('success', 'Project rejected with feedback');
}
}
