<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidUser;
use App\Http\Middleware\ValidRole;

Route::get('/', [IndexController::class, 'index'])->name('index')->middleware([ValidRole::class]);
Route::get('/login', [UserController::class, 'view'])->name('users.login');
Route::post('/loginMatch', [UserController::class, 'match'])->name('users.loginMatch')->middleware([ValidUser::class, ValidRole::class]);
Route::get('/logout', [UserController::class, 'logout'])->name('users.logout');
Route::get('/register', [UserController::class, 'create'])->name('users.create')->middleware([ValidRole::class]);
Route::post('/register', [UserController::class, 'register'])->name('users.register');