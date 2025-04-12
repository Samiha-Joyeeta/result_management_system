<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Department;
use App\Models\Profile;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\Result;
use App\Models\AssignedCourse;

class ResultController extends Controller
{
    public function index(Request $request) 
    {
        $query = Result::with('student');

        if ($request->filled('min_cgpa') && $request->filled('max_cgpa')) {
            $query->whereBetween('final_cgpa', [$request->min_cgpa, $request->max_cgpa]);
        } elseif ($request->filled('min_cgpa')) {
            $query->where('final_cgpa', '>=', $request->min_cgpa);
        } elseif ($request->filled('max_cgpa')) {
            $query->where('final_cgpa', '<=', $request->max_cgpa);
        }

        $results = $query->paginate(10);

        if (auth()->user()->user_type == User::USER_TYPE_ADMIN || auth()->user()->user_type == User::USER_TYPE_INSTRUCTOR) {
            return view('results.view', compact('results'));
        } else {
            abort(403, "Unauthorized Request");
        }
    }

    public function storeCGPA ()
    {
        $marks = DB::table('marks')
                ->join('courses', 'marks.course_id', '=', 'courses.id')
                ->select('marks.student_id', 'marks.course_id', DB::raw('SUM(marks.marks) as total_marks'), 'courses.credit')
                ->groupBy('marks.student_id', 'marks.course_id', 'courses.credit')
                ->get();
        $cgpaArray = [];
        $groupedMarks = $marks->groupBy('student_id');

        foreach ($groupedMarks as $student_id => $studentMarks) {
            $totalGPA = 0;
            $totalCredits = 0;

            foreach ($studentMarks as $mark) {
                $gpa = $this->calculateGPA($mark->total_marks);
                $weightedGPA = $gpa * $mark->credit;
                $totalGPA += $weightedGPA;
                $totalCredits += $mark->credit;

            }

            $cgpa = $totalCredits ? $totalGPA / $totalCredits : 0;
            $cgpaArray[$student_id] = $cgpa;
      

            DB::table('results')->updateOrInsert(
                ['student_id' => $student_id],
                ['final_cgpa' => $cgpa, 
                'updated_at' =>now(),
                'created_at' =>now()]
                );
        }

        return redirect()->route('results.index')->with('success', 'Result updated');
    }

    private function calculateGPA($totalMarks)
    {
        if ($totalMarks >= 80) return 4.0;
        if ($totalMarks >= 75) return 3.75;
        if ($totalMarks >= 70) return 3.5;
        if ($totalMarks >= 65) return 3.25;
        if ($totalMarks >= 60) return 3.0;
        if ($totalMarks >= 55) return 2.75;
        if ($totalMarks >= 50) return 2.5;
        if ($totalMarks >= 45) return 2.25;
        if ($totalMarks >= 40) return 2.0;
        return 0.0; 
    }

    public function showResults($student_id) 
    {
        $marks = DB::table('marks')
        ->join('courses', 'marks.course_id', '=', 'courses.id')
        ->join('semesters', 'marks.semester_id', '=', 'semesters.id')
        ->select(
            'marks.student_id', 
            'marks.course_id', 
            'marks.semester_id', 
            DB::raw('SUM(marks.marks) as total_marks'),
            'semesters.name as semester_name', 
            'courses.credit',
            'courses.name as course_name'
        )
        ->where('marks.student_id', $student_id)
        ->groupBy('marks.student_id', 'marks.course_id', 'marks.semester_id', 'semesters.name', 'courses.name', 'courses.credit')
        ->get();

        $gpaData = [];
        $groupedMarks = $marks->groupBy(['student_id', 'semester_id']);

        foreach ($groupedMarks as $student_id => $groupBySemester) {
            foreach ($groupBySemester as $semester_id => $semesterMarks) {
                $totalGPA = 0;
                $totalCredits = 0;
                $courseDetails = [];

                foreach ($semesterMarks as $mark) {
                    $courseDetails[] = [
                        'course_id' => $mark->course_id,
                        'course_name' => $mark->course_name,
                        'total_marks' => $mark->total_marks,
                        'credit' => $mark->credit
                    ];

                    $gpa = $this->calculateGPA($mark->total_marks);
                    $weightedGPA = $gpa * $mark->credit;
                    $totalGPA += $weightedGPA;
                    $totalCredits += $mark->credit;
                }

                $semesterGPA = $totalCredits ? $totalGPA / $totalCredits : 0;
                $gpaData[$student_id][$semester_id] = [
                    'gpa' => number_format($semesterGPA, 2),
                    'semester_name' => $semesterMarks->first()->semester_name,
                    'courses' => $courseDetails
                ];
            }
        }

        $result = Result::with('student')->where('student_id', $student_id)->first();
        
        return view('marks.view', compact('marks', 'result', 'gpaData'));
    }

    public function delete($student_id) 
    {

        if (auth()->user()->user_type == User::USER_TYPE_ADMIN) {
            $result = Result::where('student_id', $student_id)->first();
            $result->delete();
        }

        return redirect()->route('results.index');
    }
}
