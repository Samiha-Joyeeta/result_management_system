<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Department;
use App\Models\Profile;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\AssignedCourse;

class MarkController extends Controller
{
    public function create($exam_id)
    {
        $exam = Exam::with(['course', 'department', 'semester'])->where('id', $exam_id)->first();
        $students = User::select('users.*')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->where('users.user_type', User::USER_TYPE_STUDENT)
        ->where('profiles.department_id', $exam->department_id)
        ->where('profiles.semester_id', $exam->semester_id)
        ->with('profile')
        ->get();
        
        if ($exam->instructor_id == auth()->user()->id) {
            return view('marks.create', compact('exam', 'students'));
        } else {
            abort(403, "You are not assigned instructor of this course");
        }
    }

    public function store(Request $request)
    {
        $request->validate(
        [
            'marks' => 'required'
        ]);

        $mark = new Mark;
        $mark->student_id = $request->student_id;
        $mark->exam_id = $request->exam_id;
        $mark->course_id = $request->course_id;
        $mark->semester_id = $request->semester_id;
        $mark->marks = $request->marks;
        $mark->save();

        return redirect()->route('marks.instructor_view')->with('success', 'Marks added');
    }

    public function view($student_id)
    {
        $marks = Mark::with('student', 'course', 'semester', 'exam')->where('student_id', $student_id)
                                                            ->orderBy('semester_id')
                                                            ->get()
                                                            ->groupBy('semester_id');
        $student = Profile::where('id', $student_id)->first();

        $rowspans = [];
        foreach ($marks as $semester_id => $semesterMarks) {
            $rowspans[$semester_id] = $semesterMarks->count() + 1;
        }

        return view('marks.display', compact('marks', 'student', 'rowspans'));
    }

    public function show_marks_to_instructor(Request $request)
    {
        $instructor_id = auth()->user()->id;
        $search = $request->input('search');

        $marks = Mark::with(['student', 'course', 'exam'])
            ->whereHas('exam', function ($query) use ($instructor_id) {
                $query->where('instructor_id', $instructor_id);
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('exam', function ($studentQuery) use ($search) {
                    $studentQuery->where('exam_title', 'LIKE', '%' . $search . '%');
                });
            })
            ->paginate(10);
        
        if ($marks) {
            return view('marks.instructor_view', compact('marks'));
        } else {
            abort(404, "Access is restricted");
        }      
    }


    public function update(Request $request)
    {
        $request->validate(
        [
            'marks' => 'required'
        ]);

        $mark = Mark::find($request->id);
        $mark->marks = $request->marks;
        $mark->update();

        return response()->json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $mark = Mark::find($request->id);

        if ($mark) {
            $mark->delete();

            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }
    }
    
}
