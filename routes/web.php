<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AttendanceController;

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

Route::prefix('presensi')->group(function () {
    Route::get('/baru', [AttendanceController::class, 'new'])->name('attendance.new');
    Route::get('/histori', [AttendanceController::class, 'get'])->name('attendance.get');
    Route::get('/{id}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
    Route::get('/{id}', [AttendanceController::class, 'show'])->name('attendance.show');
    Route::put('/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
    Route::post('/', [AttendanceController::class, 'create'])->name('attendance.create');
});

Route::prefix('course')->group(function () {
    Route::get('/')->name('course.get');
    Route::get('/{id}')->name('course.show');
});

Route::view('/dashboard', 'pages.dashboard.lecturer')->name('dashboard');
