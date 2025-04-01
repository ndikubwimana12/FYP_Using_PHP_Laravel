<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Student;
use App\Models\Supervision;
use App\Models\User;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = auth()->user();
        $supervision = Supervision::where('StudentRegNumber', $student->StudentRegNumber)
            ->with('supervisor')
            ->first();
        $projects = Project::where('StudentRegNumber', $student->StudentRegNumber)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.dashboard', compact('student', 'supervision', 'projects'));
    }

    public function myProjects()
    {
        // Get the authenticated student
        $student = Student::where('StudentEmail', auth()->user()->email)->first();
        
        // Fetch all projects for this student
        $projects = Project::where('StudentRegNumber', $student->StudentRegNumber)
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('student.my-projects', compact('projects'));
    }
    

    public function supervisorInfo()
    {
        $student = Student::where('StudentEmail', auth()->user()->email)->first();
        
        $supervision = Supervision::where('StudentRegNumber', $student->StudentRegNumber)
            ->with('supervisor')
            ->first();
    
        return view('student.supervisor-info', compact('supervision'));
    }
    

    public function submitProposal(Request $request)
{
    // Get the student registration number from the authenticated student
    $student = Student::where('StudentEmail', auth()->user()->email)->first();
    $studentRegNumber = $student->StudentRegNumber;

    $validated = $request->validate([
        'ProjectName' => 'required|string|max:255',
        'ProjectProblems' => 'required|string',
        'ProjectSolutions' => 'required|string',
        'ProjectAbstract' => 'required|string',
        'ProjectDissertation' => 'required|mimes:pdf,doc,docx|max:10240',
        'ProjectSourceCodes' => 'required|mimes:zip,rar|max:51200'
    ]);

    $dissertationFile = time() . '_dissertation.' . $request->ProjectDissertation->extension();
    $sourceCodeFile = time() . '_source.' . $request->ProjectSourceCodes->extension();

    $request->ProjectDissertation->move(public_path('dissertations'), $dissertationFile);
    $request->ProjectSourceCodes->move(public_path('sourcecodes'), $sourceCodeFile);

    Project::create([
        'ProjectCode' => 'PRJ' . time(),
        'ProjectName' => $validated['ProjectName'],
        'ProjectProblems' => $validated['ProjectProblems'],
        'ProjectSolutions' => $validated['ProjectSolutions'],
        'ProjectAbstract' => $validated['ProjectAbstract'],
        'ProjectDissertation' => $dissertationFile,
        'ProjectSourceCodes' => $sourceCodeFile,
        'StudentRegNumber' => $studentRegNumber,
        'status' => 'pending'
    ]);

    return redirect()->route('student.my-projects')->with('success', 'Project submitted successfully');
}


    public function showProposalForm()
    {
        $student = auth()->user();
        $supervision = Supervision::where('StudentRegNumber', $student->StudentRegNumber)
            ->with('supervisor')
            ->first();

        return view('student.submit-proposal', compact('student', 'supervision'));
    }

    public function searchProjects(Request $request)
    {
        $query = $request->input('query');
        $projects = Project::where('status', 'approved')
            ->where(function ($q) use ($query) {
                $q->where('ProjectName', 'like', "%{$query}%")
                    ->orWhere('Description', 'like', "%{$query}%");
            })
            ->with(['student'])
            ->paginate(10);

        return view('student.search-projects', compact('projects', 'query'));
    }
}
