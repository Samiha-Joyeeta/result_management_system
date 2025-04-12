<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssignedCourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\ResultController;
use App\Http\Middleware\ValidUser;
use App\Http\Middleware\ValidRole;
use App\Models\User;

Route::get('/', [UserController::class, 'view'])->name('users.login');
Route::post('/loginMatch', [UserController::class, 'match'])->name('users.loginMatch')->middleware([ValidUser::class]);

Route::prefix('admin')->middleware(['validRole:'. User::USER_TYPE_ADMIN])->group(function () {
    Route::get('/dashboard', [IndexController::class, 'view_admin_dashboard'])->name('index');
    Route::post('/register', [UserController::class, 'register'])->name('users.register');
    Route::get('/users', [UserController::class, 'view_all_users'])->name('user.view');
    Route::put('/users/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/user/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/students', [UserController::class, 'student_list'])->name('students');
    Route::get('/instructors', [UserController::class, 'instructor_list'])->name('instructor');
    Route::resource('departments', DepartmentController::class);
    Route::resource('semesters', SemesterController::class);
    Route::resource('courses', CourseController::class);
    Route::get('/assigned_courses/create', [AssignedCourseController::class, 'create'])->name('assigned_courses.create');
    Route::post('/assigned_courses/store', [AssignedCourseController::class, 'store'])->name('assigned_courses.store');
    Route::get('/assigned_courses', [AssignedCourseController::class, 'index'])->name('assigned_courses.index');
    Route::get('/assigned_courses/{id}/edit', [AssignedCourseController::class, 'edit'])->name('assigned_courses.edit');
    Route::put('/assigned_courses/{id}', [AssignedCourseController::class, 'update'])->name('assigned_courses.update');
    Route::delete('/exams/{id}/delete', [AssignedCourseController::class, 'delete'])->name('assigned_courses.delete');
});
Route::prefix('instructor')->middleware(['validRole:'. User::USER_TYPE_INSTRUCTOR])->group(function () {
    Route::get('/dashboard', [IndexController::class, 'view_instructor_dashboard'])->name('instructor.dashboard');
    Route::get('/marks/{exam_id}/create', [MarkController::class, 'create'])->name('marks.create');
    Route::post('/marks/store', [MarkController::class, 'store'])->name('marks.store');
    Route::get('/exams/{assigned_course_id}/create', [ExamController::class, 'create'])->name('exams.create');
    Route::post('/exams/store', [ExamController::class, 'store'])->name('exams.store');
    Route::get('/exams/{id}/edit', [ExamController::class, 'edit'])->name('exams.edit');
    Route::put('/exams/{id}', [ExamController::class, 'update'])->name('exams.update');
    Route::delete('/exams/{id}/delete', [ExamController::class, 'delete'])->name('exams.delete');
    Route::get('/course/marks', [MarkController::class, 'show_marks_to_instructor'])->name('marks.instructor_view');
    Route::put('/marks/update', [MarkController::class, 'update'])->name('marks.update');
    Route::delete('/marks/delete', [MarkController::class, 'delete'])->name('marks.delete');
});
Route::prefix('student')->middleware(['validRole:'. User::USER_TYPE_STUDENT])->group(function () {
    Route::get('/dashboard', [IndexController::class, 'view_student_dashboard'])->name('student.dashboard');
});
Route::get('/logout', [UserController::class, 'logout'])->name('users.logout');
Route::post('/loginMatch', [UserController::class, 'match'])->name('users.loginMatch')->middleware([ValidUser::class]);
Route::get('/profile/{id}', [ProfileController::class, 'view'])->name('profile.index');
Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');
Route::get('/results', [ResultController::class, 'index'])->name('results.index');
Route::get('/results/{student_id}', [ResultController::class, 'showResults'])->name('results.show');
Route::post('/results/store', [ResultController::class, 'storeCGPA'])->name('results.store');
Route::delete('/results/{student_id}', [ResultController::class, 'delete'])->name('results.delete');
Route::get('/marks/{student_id}', [MarkController::class, 'view'])->name('marks.view');
Route::get('/instructor/{instructor_id}/assigned_courses', [AssignedCourseController::class, 'instructor_wise_assigned_course_view'])->name('instructor_wise_assigned_course_view');
Route::get('/instructor/{instructor_id}/department/{department_id}/course/{course_id}', [AssignedCourseController::class, 'department_course_wise_students_view'])->name('department_course_wise_students_view');