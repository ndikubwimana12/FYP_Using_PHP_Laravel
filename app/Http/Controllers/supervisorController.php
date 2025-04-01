<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SupervisorController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $supervisors = Supervisor::with('department')->get();

        return view('Admin-supervisors', compact('departments', 'supervisors'));
    }

    public function insert(Request $request)
    {
        $validated = $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'SupervisorEmail' => 'required|email|unique:supervisor,SupervisorEmail',
            'PhoneNumber' => 'required|string|max:20',
            'DepartmentCode' => 'required|exists:department,DepartmentCode',
            'password' => 'required|min:6'
        ]);

        DB::transaction(function () use ($validated) {
            // Create user first
            $user = User::create([
                'name' => $validated['FirstName'] . ' ' . $validated['LastName'],
                'email' => $validated['SupervisorEmail'],
                'password' => Hash::make($validated['password']),
                'role' => 'supervisor'
            ]);

            // Create supervisor after ensuring $user is created
            $supervisor = Supervisor::create([
                'SupervisorFirstName' => $validated['FirstName'],
                'SupervisorLastName' => $validated['LastName'],
                'SupervisorEmail' => $validated['SupervisorEmail'],
                'SupervisorPhoneNumber' => $validated['PhoneNumber'],
                'DepartmentCode' => $validated['DepartmentCode'],
                'password' => Hash::make($validated['password']),
                'user_id' => $user->id // Ensure user_id is properly set
            ]);
        });

        // Automatically log in the new supervisor
        auth()->attempt([
            'email' => $validated['SupervisorEmail'],
            'password' => $validated['password']
        ]);

        return redirect()->route('admin.supervisors')->with('success', 'Supervisor added successfully');
    }
}
