<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'role' => 'required'
    ]);

    $guard = $request->role;

    if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();

        switch($request->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'department':  // Changed from 'faculty' to 'department'
                return redirect()->route('department.dashboard');
            case 'supervisor':
                return redirect()->route('supervisor.dashboard');
            case 'student':
                return redirect()->route('student.dashboard');
        }
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}


}
