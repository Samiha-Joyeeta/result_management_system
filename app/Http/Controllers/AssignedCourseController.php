<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Profile;
use App\Models\Semester;
use App\Models\Course;
use App\Models\Exam;
use App\Models\AssignedCourse;
use Illuminate\Support\Facades\Auth;

class AssignedCourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::with('department')->get();
        $semesters = Semester::all();
        $instructors = User::where('user_type', User::USER_TYPE_INSTRUCTOR)->get();
        $query = AssignedCourse::with('course', 'department', 'instructor', 'semester');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->WhereHas('course', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            })
            ->orWhereHas('instructor', function ($q) use ($search) {
                $q->where('username', 'LIKE', "%$search%");
            })
            ->orWhereHas('semester', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            });
        }

        $assigned_courses = $query->paginate(10);

        return view('assigned_courses.view', compact('assigned_courses', 'courses', 'instructors', 'semesters'));
    }

    public function store(Request $request)
    {   
        $assigned_course = new AssignedCourse;
        $assigned_course->course_id = $request->course_id;
        $assigned_course->semester_id = $request->semester_id;
        $assigned_course->instructor_id = $request->instructor_id;
        $assigned_course->created_by = auth()->user()->id;
        $assigned_course->save();

        return redirect()->route('assigned_courses.index')->with('success', 'Course is assigned to an instructor');
    }

    public function edit($id)
    {
        $assigned_course = AssignedCourse::with('course', 'department', 'instructor')->where('id', $id)->first();
        $courses = Course::with('department')->get();
        $departments = Department::all();
        $semesters = Semester::all();
        $instructors = User::where('user_type', User::USER_TYPE_INSTRUCTOR)->get();

        return view('assigned_courses.edit', compact('assigned_course', 'courses', 'instructors', 'semesters'));
    }

    public function update(Request $request, $id)
    {
        $assigned_course = AssignedCourse::find($id);
        $assigned_course->update($request->all());

        return redirect()->route('assigned_courses.index')->with('success', 'Course and instructor details are updated');
    }

    public function delete($id)
    {
        $assigned_course = AssignedCourse::find($id);
        
        if ($assigned_course) {
            $assigned_course->delete();
            
            return redirect()->route('assigned_courses.index')->with('success', 'Course and instructor details are deleted');
        } else {
            return redirect()->route('assigned_courses.index')->with('error', 'Assigned Course not found');
        }
    }

    public function instructor_wise_assigned_course_view($instructor_id)
    {
        $assigned_courses = AssignedCourse::with('course', 'department', 'instructor', 'semester')->where('instructor_id', $instructor_id)->paginate(10);

        if ($instructor_id == auth()->user()->id || auth()->user()->user_type == User::USER_TYPE_ADMIN) {
            return view('assigned_courses.instructor_wise_view', compact('assigned_courses'));
        } else {
            abort(404, "Not permitted to access");
        }
    }

    public function department_course_wise_students_view($instructor_id, $department_id, $course_id)
    {
        $instructor = User::where('id', $instructor_id)->first();
        $course = Course::where('id', $course_id)->first();
        $department = Department::where('id', $department_id)->first();
        $search = request()->query('search');
        $students = Profile::with('user', 'marks')->where('department_id', $department_id)
                                                  ->whereNotNull('session')
                                                  ->whereHas('marks', function ($query) use ($course_id) {
                                                    $query->where('course_id', $course_id);
                                                    })
                                                    ->when($search, function ($query, $search) {
                                                        $query->whereHas('user', function ($query) use ($search) {
                                                            $query->where('username', 'like', '%' . $search . '%')
                                                                  ->orWhere('registration_number', 'like', '%' . $search . '%');
                                                        });
                                                    })
                                                  ->paginate(10);

        if ($instructor_id == auth()->user()->id || auth()->user()->user_type == User::USER_TYPE_ADMIN) {
            return view('department_course_wise_students_view', compact('instructor', 'course', 'department', 'students'));
        } else {
            abort(404, "Not permitted to access");
        }
    }
}
