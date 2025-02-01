<?php


use App\Http\Controllers\Api\HolidayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Dashboard\DashboardController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\Auth\UserController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Api\Employee\EmployeeController;
use App\Http\Controllers\Api\Leave\EmployeeLeaveController;
use App\Http\Controllers\Api\Leave\LeaveManagementController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

// Protected Routes (Requires Authentication)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('department', DepartmentController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('attendance', AttendanceController::class);
    Route::resource('holidays', HolidayController::class);
    Route::resource('leaves', LeaveManagementController::class);
    Route::resource('employeeLeave',EmployeeLeaveController::class);

    // Logout Route
    Route::post('/logout', [UserController::class, 'logout']);
});
