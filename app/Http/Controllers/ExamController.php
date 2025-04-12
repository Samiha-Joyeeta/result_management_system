<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Profile;
use App\Models\Course;
use App\Models\AssignedCourse;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index(Request $request)
    {
        $query = Exam::with('course', 'department', 'semester', 'instructor');

        if ($request->filled('exam_type')) {
            $query->where('exam_type', $request->exam_type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('exam_title', 'LIKE', "%$search%")
                  ->orWhere('marks', 'LIKE', "%$search%")
                 ->orWhereHas('course', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            })
            ->orWhereHas('instructor', function ($q) use ($search) {
                $q->where('username', 'LIKE', "%$search%");
            })
            ->orWhereHas('department', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            })
            ->orWhereHas('semester', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            });
        }

        $exams = $query->paginate(10);

        return view('exams.view', compact('exams'));
    }

    public function create($assigned_course_id)
    {
        $assigned_course = AssignedCourse::with('course', 'department', 'semester', 'instructor')->where('id', $assigned_course_id)->first();

        return view('exams.create', compact('assigned_course'));
    }

    public function store(Request $request)
    {   $request->validate(
        [
            'marks' => 'required',
            'exam_title' => 'required'
        ]);

        $exam = new Exam;
        $exam->course_id = $request->course_id;
        $exam->exam_title = $request->exam_title;
        $exam->department_id = $request->department_id ;
        $exam->semester_id = $request->semester_id;
        $exam->exam_type = $request->exam_type;
        $exam->marks = $request->marks;
        $exam->instructor_id = $request->instructor_id;
        $exam->created_by = auth()->user()->id;
        $exam->save();

        return redirect()->route('instructor.dashboard')->with('success', 'Exam is created Successfully');
    }

    public function edit($id)
    {
        $exam = Exam::with('course', 'department', 'instructor', 'semester')->where('id', $id)->first();

        return view('exams.edit', compact('exam'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'marks' => 'required',
                'exam_title' => 'required'
            ]);

        $exam = Exam::find($id);
        $exam->exam_title = $request->exam_title;
        $exam->exam_type = $request->exam_type;
        $exam->marks = $request->marks;
        $exam->update();

        return redirect()->route('instructor.dashboard')->with('success', 'Exam is updated Successfully');
    }
    public function delete($id)
    {
        $exam = Exam::find($id);

        if ($exam) {
            $exam->delete();

            return redirect()->route('instructor.dashboard')->with('success', 'Exam is deleted Successfully');
        } else {
            return redirect()->route('instructor.dashboard')->with('error', 'Exam could not be found');
        }
    }
}
