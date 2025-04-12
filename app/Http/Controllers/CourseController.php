<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Profile;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departments = Department::all();
        $query = Course::with('department');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%$search%")
                ->orWhereHas('department', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            });
        }

    $courses = $query->paginate(10);

        return view('courses.view', compact('courses', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'department_id' => 'required',
            'credit' => 'required'
        ]);

        $course = new Course;
        $course->name = $request['name'];
        $course->credit = $request['credit'];
        $course->department_id = $request['department_id'];
        $course->created_by = auth()->user()->id;
        $course->save();

        return redirect()->route('courses.index')->with('success', 'Course is created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        $departments = Department::all();

        return view('courses.edit', compact('course', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'credit' => 'required'
        ]);

        $course = Course::find($id);
        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Course is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if (!is_null($course)) {
            $course->delete();

            return redirect()->route('courses.index')->with('success','Course is deleted successfully');
        } else {
            return redirect()->route('courses.index')->with('error','Course could not be not found');
        }

    }
}
