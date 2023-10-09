<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::post('import-employee',[App\Http\Controllers\EmployeeController::class,'import'])->name('import-employee');
Route::get('export-employee',[App\Http\Controllers\EmployeeController::class,'export'])->name('export-employee');
Route::get('employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.index');

Route::get('attendance', [App\Http\Controllers\AttendanceController::class, 'index'])->name('attendance.index');
Route::get('attendance-dashboard', [App\Http\Controllers\AttendanceController::class, 'attendance'])->name('attendance.dashboard');
Route::post('import-attendance',[App\Http\Controllers\AttendanceController::class,'import'])->name('import-attendance');
Route::get('export-attendance',[App\Http\Controllers\AttendanceController::class,'export'])->name('export-attendance');  

// Reimbersment
Route::get('reimbursement', [App\Http\Controllers\ReimbursementController::class, 'index'])->name('reimbursement.index');


Route::resources([
    'tasks' => App\Http\Controllers\TaskController::class,
]);
Route::resources([
    'user-management' => App\Http\Controllers\UserController::class,
]);

Route::resources([
    'daily' => App\Http\Controllers\ReportController::class,
]);

route::get('notice', [App\Http\Controllers\EmployeeController::class, 'report'])->name('emp.notice');

//Tasks List
//Route::resource('tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
//Tasks List
//Route::get('tasks/create', [App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');


// Usermanagement

//Route::resources('user-management', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');



//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
