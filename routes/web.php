<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentRegisterController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HodController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\SupervisorDashboardController;
use App\Http\Controllers\DepartmentDashboardController;
use App\Http\Controllers\ProjectAssignmentController;
use App\Http\Controllers\StudentDashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function(){
    return view('login');
});
Route::get('/signup', [StudentRegisterController::class, 'showRegistrationForm']);

Route::get('/login', function(){
    return view('signin');
});
Route::get('/student', function(){
    return view('StudentDashboard');
});
Route::get('/admin', function(){
    return view('AdminDashboard');
});

Route::post('/hod/insert',[HodController::class, 'insertHod'])->name('hod.insert');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/signup', [StudentRegisterController::class, 'showRegistrationForm'])->name('signup');
Route::post('/student/register', [StudentRegisterController::class, 'register'])->name('student.register');
Route::post('/admin', function() {
    return view('AdminDashboard')->name('admin.dashboard');
})->name('admin.dashboard');
Route::get('/admin/students', function() {
    return view('Admin-students');
})->name('admin.students');

// Route::get('/supervisor.insert', [Supervisor])


Route::get('/admin/supervisors', function() {
    return view('Admin-supervisors');
})->name('admin.supervisors');

Route::get('/admin/departments', [DepartmentController::class, 'showForm'])->name('admin.departments');
Route::get('/student/dashboard', function() {
    return view('StudentDashboard');
})->name('student.dashboard')->middleware('auth');

Route::get('/admin/projects', function() {
    return view('Admin-projects');
})->name('admin.projects');

Route::get('/admin/Hod', [HodController::class , 'showHodForm'])->name('admin.hod');

Route::get('/admin/profile', function() {
    return view('Admin-profile');
})->name('admin.profile');

Route::get('/admin/settings', function() {
    return view('Admin-settings');
})->name('admin.settings');
Route::get('/logout', function() {
    return view('/login');
})->name('logout');

Route::get('/login', [StudentLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [StudentLoginController::class, 'login']);


Route::get('/departments', [DepartmentController::class, 'index']);
Route::get('/departments/{code}', [DepartmentController::class, 'show']);

Route::post('/department/insert', [DepartmentController::class, 'storeDepartment'])->name('department.insert');

Route::get('/student/profile', [StudentDashboardController::class, 'profile'])->name('student.profile');

//supervisor routes 
Route::get('/admin/supervisors', [SupervisorController::class, 'index'])->name('admin.supervisors');
Route::post('/admin/supervisor/insert', [SupervisorController::class, 'insert'])->name('supervisor.insert');
Route::get('/supervisor/dashboard', [SupervisorDashboardController::class, 'index'])->name('supervisor.dashboard');



//department routes
Route::get('/department/dashboard', [DepartmentDashboardController::class, 'index'])->name('department.dashboard');
Route::get('/projects/assign', [ProjectAssignmentController::class, 'index'])->name('projects.assign');
Route::post('/projects/assign', [ProjectAssignmentController::class, 'assign'])->name('projects.assign.store');

Route::prefix('department')->name('department.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DepartmentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/supervisors', [DepartmentDashboardController::class, 'supervisors'])->name('supervisors');
    Route::get('/students', [DepartmentDashboardController::class, 'students'])->name('students');
    Route::get('/projects', [DepartmentDashboardController::class, 'projects'])->name('projects');
    Route::get('/reports', [DepartmentDashboardController::class, 'reports'])->name('reports');
});

Route::get('/department/assign-supervisors', [DepartmentDashboardController::class, 'assignSupervisorView'])
    ->name('department.assign.supervisors');

    Route::prefix('department')->name('department.')->middleware(['auth'])->group(function () {
        // Existing routes
        Route::get('/assign-supervisors', [DepartmentDashboardController::class, 'assignSupervisorView'])->name('assign.supervisors');
        Route::post('/assign-supervisor', [DepartmentDashboardController::class, 'assignSupervisor'])->name('assign.supervisor');
    });

    Route::prefix('supervisor')->name('supervisor.')->middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [SupervisorDashboardController::class, 'index'])->name('dashboard');
        
        // Students
        Route::get('/students', [SupervisorDashboardController::class, 'students'])->name('students');
        
        // Projects
        Route::get('/projects', [SupervisorDashboardController::class, 'projects'])->name('projects');
        Route::get('/project/{code}', [SupervisorDashboardController::class, 'viewProject'])->name('project.view');
        
        // Meetings
        Route::get('/meetings', [SupervisorDashboardController::class, 'meetings'])->name('meetings');
        Route::post('/meetings/schedule', [SupervisorDashboardController::class, 'scheduleMeeting'])->name('meetings.schedule');
        
        // Reports
        Route::get('/reports', [SupervisorDashboardController::class, 'reports'])->name('reports');
        
        // Profile & Settings
        Route::get('/profile', [SupervisorDashboardController::class, 'profile'])->name('profile');
        Route::get('/settings', [SupervisorDashboardController::class, 'settings'])->name('settings');
        Route::post('/profile/update', [SupervisorDashboardController::class, 'updateProfile'])->name('profile.update');
    });
    
    Route::post('/supervisor/generate-report', [SupervisorDashboardController::class, 'generateReport'])->name('supervisor.generate.report');
    
    Route::prefix('supervisor')->name('supervisor.')->middleware(['auth'])->group(function () {
        Route::get('/pending-projects', [SupervisorDashboardController::class, 'pendingProjects'])->name('pending.projects');
        Route::get('/projects/{code}/approve', [SupervisorDashboardController::class, 'approveProject'])->name('project.approve');
        Route::post('/projects/{code}/reject', [SupervisorDashboardController::class, 'rejectProject'])->name('project.reject');
    });
    Route::prefix('student')->name('student.')->middleware(['auth'])->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::get('/my-projects', [StudentDashboardController::class, 'myProjects'])->name('my-projects');
        Route::get('/supervisor-info', [StudentDashboardController::class, 'supervisorInfo'])->name('supervisor-info');
        Route::get('/submit-proposal', [StudentDashboardController::class, 'showProposalForm'])->name('submit.proposal');
        Route::post('/submit-proposal', [StudentDashboardController::class, 'submitProposal']);
        Route::get('/search-projects', [StudentDashboardController::class, 'searchProjects'])->name('search.projects');
    });
    Route::post('/department/generate-report', [DepartmentDashboardController::class, 'generateReport'])->name('department.generate.report');

    
