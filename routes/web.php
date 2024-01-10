<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PBM\AbsentController;
use App\Http\Controllers\PBM\AttendanceController as PBMAttendanceController;
use App\Http\Controllers\PBM\ExcuseController;
use App\Http\Controllers\PBM\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['api.auth', 'api.islecturer'])->group(function () {
    Route::prefix('presensi')->group(function () {
        Route::get('/baru', [AttendanceController::class, 'new'])->name('attendance.new');
        Route::get('/histori', [AttendanceController::class, 'get'])->name('attendance.get');
        Route::get('/{id}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
        Route::get('/{id}', [AttendanceController::class, 'show'])->name('attendance.show');
        Route::patch('/{id}/finalize', [AttendanceController::class, 'finalize'])->name('attendance.finalize');
        Route::patch('/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
        Route::post('/{id}/mahasiswa', [AttendanceController::class, 'add_student'])->name('attendance.add_student');
        Route::post('/', [AttendanceController::class, 'create'])->name('attendance.create');
    });

    Route::prefix('course')->group(function () {
        Route::get('/', [CourseController::class, 'get'])->name('course.get');
        Route::get('/{id}')->name('course.show');
    });
});

Route::middleware(['api.auth', 'api.ispbm'])->prefix('pbm')->group(function () {
    Route::prefix('presensi')->group(function () {
        Route::get('/');
    });

    Route::prefix('ketidakhadiran')->group(function () {
        Route::get('/', [AbsentController::class, 'get'])->name('pbm.absent.get');
        Route::get('/{id}', [AbsentController::class, 'show'])->name('pbm.absent.show');
    });

    Route::prefix('suratijin')->group(function () {
        Route::post('/{id}/update', [ExcuseController::class, 'update'])->name('pbm.excuse.update');
    });

    Route::prefix('mahasiswa')->group(function () {
        Route::get('/', [StudentController::class, 'get'])->name('pbm.student.get');
        Route::get('/{id}', [StudentController::class, 'show'])->name('pbm.student.show');
    });
});

Route::view('/dashboard', 'pages.dashboard.lecturer')->name('dashboard')->middleware('api.auth');

Route::view('login', 'pages.user.login')->name('auth.login');
Route::view('testingpbm', 'pages.pbmblank');
Route::post('login', [AuthController::class, 'login'])->name('auth.login-action');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
