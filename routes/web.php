<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidUser;
use App\Http\Middleware\ValidRole;

Route::prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/register', [UserController::class, 'create'])->name('users.create');
    Route::get('/users', [UserController::class, 'view_all_users'])->name('user.view');
})->middleware([ValidRole::class . ':1']);
Route::get('/login', [UserController::class, 'view'])->name('users.login');
Route::post('/loginMatch', [UserController::class, 'match'])->name('users.loginMatch')->middleware([ValidUser::class]);
Route::get('/logout', [UserController::class, 'logout'])->name('users.logout');
Route::post('/register', [UserController::class, 'register'])->name('users.register');
Route::get('/instructor', [UserController::class, 'view_instructor_dashboard'])->name('instructor.dashboard')->middleware([ValidRole::class .':2']);
Route::get('/student', [UserController::class, 'view_student_dashboard'])->name('student.dashboard')->middleware([ValidRole::class .':3']);
