<?php
namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Hod;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class HodController extends Controller
{
    public function showHodForm()
    {
        $departments = Department::all();
        $hods = Hod::all();
        return view('Admin-department-hod', compact('departments', 'hods'));
    }

    public function insertHod(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'Gender' => 'required|string',
            'Email' => 'required|email|unique:hod',
            'PhoneNumber' => 'required|string|max:15',
            'password' => 'required|string|min:6',
            'DepartmentCode' => 'required|string',
        ]);

        DB::transaction(function () use ($validated) {
            // Create user
            $user = User::create([
                'name' => $validated['FirstName'] . ' ' . $validated['LastName'],
                'email' => $validated['Email'],
                'password' => Hash::make($validated['password']),
                'role' => 'hod'
            ]);

            $student = Hod::create([
                'FirstName' => $validated['FirstName'],
                'LastName' => $validated['LastName'],
                'Gender' => $validated['Gender'],
                'Email' => $validated['Email'],
                'PhoneNumber' => $validated['PhoneNumber'],
                'password' => Hash::make($validated['password']),
                'DepartmentCode' => $validated['DepartmentCode'],
                'user_id' => $user->id
            ]);
        });


        auth()->attempt([
            'email' => $validated['Email'],
            'password' => $validated['password']
        ]);

        return redirect()->route('admin.hod')->with('success', 'HOD added successfully');
    }
}
