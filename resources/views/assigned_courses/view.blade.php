@extends('layouts.view')

@push('title')
    <title>Assigned Courses List</title>
@endpush

@section('main-section')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <div class="container">
        <div class="card justify-content-center">
            <div class="card-body">
                <div class="g-4 p-2">
                    <h3 class="text-center">Assign Courses To Instructors</h3>
                    <form action="{{ route('assigned_courses.store') }}" method="POST"  class="row g-3">
                        @csrf
                            <div class="col-md-4">
                            <label for="course_id" class="form-label">Course</label>
                            <select name="course_id" id="course_id" class="form-select">
                                @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="semester" class="form-label">Semester</label>
                            <select name="semester_id" id="semester" class="form-select">
                                @foreach ($semesters as $semester)
                                    <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                                @endforeach
                                @error('semester')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="instructor" class="form-label">Instructor</label>
                            <select name="instructor_id" id="instructor" class="form-select">
                                @foreach ($instructors as $instructor)
                                        <option value="{{ $instructor->id }}">{{ $instructor->username }}</option>
                                @endforeach
                            </select>
                            @error('instructor')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark text-center">Submit</button>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
    </div>
   
    <div class="text-center">
        <h1 class="text-center">Assigned Courses</h1>

        <form action="{{ route('assigned_courses.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                </div>
    
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark">Search</button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Course Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Instructor</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assigned_courses as $assigned_course)
                    <tr>
                        <th scope="row">{{ $assigned_course->course->name }}</th>
                        <td>{{ $assigned_course->course->department->name }}</td>
                        <td>{{ $assigned_course->semester->name }}</td>
                        <td>{{ $assigned_course->instructor->username }}</td>
                        <td> 
                            <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                <a href="{{ route('assigned_courses.edit', $assigned_course->id) }}"><button type="submit" class="btn btn-info">Edit</button></a>
                                <form action="{{ route('assigned_courses.delete', $assigned_course->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div> 
                        </td>
                    </tr>     
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $assigned_courses->links() }}

@endsection