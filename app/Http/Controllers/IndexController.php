<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Department;
use App\Models\Semester;
use App\Models\AssignedCourse;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\Result;
use Illuminate\Validation\Rules\Password;

class IndexController extends Controller
{
    public function view_admin_dashboard()
    {
        $users = User::orderBy('created_at', 'desc')->limit(10)->get();
        $studentCount = User::where('user_type', User::USER_TYPE_STUDENT)->count();
        $instructorCount = User::where('user_type', User::USER_TYPE_INSTRUCTOR)->count();
        $adminCount = User::where('user_type', User::USER_TYPE_ADMIN)->count();
        $departmentCount = Department::count();

        return view('index', compact('users', 'studentCount', 'instructorCount', 'adminCount', 'departmentCount'));
    }

    public function view_instructor_dashboard()
    {
        
        $assigned_courses = AssignedCourse::with('course', 'department', 'instructor', 'semester')->where('instructor_id', auth()->user()->id)->paginate(10);
        $exams = Exam::with('course', 'department', 'semester', 'instructor')->where('instructor_id', auth()->user()->id)->paginate(10);

        return view('instructor_dashboard', compact('assigned_courses', 'exams'));
    }

    public function view_student_dashboard()
    {
        $user_id = auth()->user()->id;
        $student = Profile::where('user_id', $user_id)->first();
        $marks = Mark::with('course', 'semester', 'exam')->where('student_id', $student->id)->get()->groupBy('course_id');

        return view('student_dashboard', compact('student', 'marks'));
    }
}
