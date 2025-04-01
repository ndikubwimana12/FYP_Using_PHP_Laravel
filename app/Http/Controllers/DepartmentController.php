<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Compus;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function showForm(){
        $compuses = Compus::all();
        return view('Admin-departments', compact('compuses'));
    }

    public function storeDepartment(Request $request){
        $department = new Department;
        $department-> DepartmentCode = $request->input('Department_code');
        $department-> DepartmentName = $request->input('DepartmentName');
        $department-> CampusId = $request->input('compus_id');
        $department->save();

        return redirect('admin.departments')->with('insert_message', 'Department Added');
    }
    






    //normal function
    public function index()
    {
        $departments = Department::with('campus')->get();
        return view('departments.index', compact('departments'));
    }

    public function show($code)
    {
        $department = Department::with('campus')->findOrFail($code);
        return view('departments.show', compact('department'));
    }
}
