<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ExportController;
use App\Http\Controllers\Api\FaceRecognitionController;
use App\Http\Controllers\Api\SchoolClassController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\ActivityLogController;
use App\Http\Controllers\Api\StudentTrainingPhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Auth routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Class routes
Route::apiResource('classes', SchoolClassController::class);

// Student routes
Route::apiResource('students', StudentController::class);

// Attendance routes
Route::apiResource('attendances', AttendanceController::class);
Route::get('/attendances/report/daily', [AttendanceController::class, 'dailyReport']);
Route::get('/attendances/report/monthly', [AttendanceController::class, 'monthlyReport']);

// Activity log routes
Route::apiResource('activity-logs', ActivityLogController::class);

// Student training photos routes
Route::apiResource('student-training-photos', StudentTrainingPhotoController::class);

// Face recognition routes
Route::post('/face-recognition', [FaceRecognitionController::class, 'recognizeFace']);
Route::post('/manual-attendance', [FaceRecognitionController::class, 'manualAttendance']);

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index']);

// Export routes
Route::get('/export/students/csv', [ExportController::class, 'exportStudentsCSV']);
Route::get('/export/attendance/csv', [ExportController::class, 'exportAttendanceCSV']);
Route::get('/export/students/pdf', [ExportController::class, 'exportStudentsPDF']);
Route::get('/export/attendance/pdf', [ExportController::class, 'exportAttendancePDF']);
