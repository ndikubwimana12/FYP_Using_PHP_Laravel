<?php

namespace App\Http\Controllers;

use App\Models\Student;  // <-- Import the Student model
use Illuminate\Http\Request;

class StudentRegisterController extends Controller
{
    public function student(){
        return view('student');
    }

    public function insert(Request $request) {
        // Initialize $student as a new Student instance
        $student = new Student;

        // Assign form data to the student model
        $student->reg_number = $request->input('reg_number');
        $student->fname = $request->input('fname');
        $student->lname = $request->input('lname');
        $student->gender = $request->input('gender');
        $student->email = $request->input('email');
        $student->phone = $request->input('phone');
        $student->password = bcrypt($request->input('password'));  // Always hash passwords!
        
        // Save the student record to the database
        $student->save();

        // Redirect with a success message
        return redirect('/')->with('insert_message', 'Well registered');
    }
}