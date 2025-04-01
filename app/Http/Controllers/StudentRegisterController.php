<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $departments = Department::all();
        return view('Signup', compact('departments'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'StudentRegNumber' => 'required|unique:Student',
            'StudentFirstName' => 'required',
            'StudentLastName' => 'required',
            'StudentGender' => 'required|in:Male,Female',
            'StudentEmail' => 'required|email|unique:Student,StudentEmail|unique:users,email',
            'StudentPhoneNumber' => 'required|unique:Student',
            'password' => 'required|min:8|confirmed',
            'DepartmentCode' => 'required|exists:Department,DepartmentCode'
        ]);
        // Check registration number validity
        if (!Student::isValidRegNumber($request->StudentRegNumber)) {
            return redirect()->back()->with('error', 'Invalid registration number. It must contain "RP" and cannot be "0000".');
        }

        DB::transaction(function () use ($validated) {
            // Create User record
            $user = User::create([
                'name' => $validated['StudentFirstName'] . ' ' . $validated['StudentLastName'],
                'email' => $validated['StudentEmail'],
                'password' => Hash::make($validated['password']),
                'role' => 'student'
            ]);

            // Create Student record
            $student = Student::create([
                'StudentRegNumber' => $validated['StudentRegNumber'],
                'StudentFirstName' => $validated['StudentFirstName'],
                'StudentLastName' => $validated['StudentLastName'],
                'StudentGender' => $validated['StudentGender'],
                'StudentEmail' => $validated['StudentEmail'],
                'StudentPhoneNumber' => $validated['StudentPhoneNumber'],
                'password' => Hash::make($validated['password']),
                'DepartmentCode' => $validated['DepartmentCode'],
                'user_id' => $user->id
            ]);
        });

        // Log the user in
        auth()->attempt([
            'email' => $validated['StudentEmail'],
            'password' => $validated['password']
        ]);

        return redirect()->route('student.dashboard');
    }
}
