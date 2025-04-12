<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Profile;
use App\Models\Course;
use App\Models\Semester;
use Illuminate\Validation\Rule;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Semester::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            });
        }

        $semesters = $query->paginate(10);

        return view('semesters.view', compact('semesters'));
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
        $request->validate(
            [
                'name' => 'required|unique:semesters,name'
            ]);

        $semester = new Semester;
        $semester->name = $request['name'];
        $semester->created_by = auth()->user()->id;
        $semester->save();

        return redirect()->route('semesters.index')->with('success', 'New semester is created successfully');
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
        $semester = Semester::find($id);

        return view('semesters.edit', compact('semester'));
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
        $semester = Semester::find($id);

        $request->validate(
            [
               'name' => [
                'required',
                Rule::unique('semesters', 'name')->ignore($semester->id),
                ]
            ]);
        
        $semester->update($request->all());

        return redirect()->route('semesters.index')->with('success', 'Semester is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $semester = Semester::find($id);

        if ($semester) {
            $semester->delete();
            return redirect()->route('semesters.index')->with('success', 'Semester is deleted successfully');
        } else {
            return redirect()->route('semesters.index')->with('error', 'Semester could not be found');
        }
    }
}
