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
    
    <div class="mt-5">
    </div>
   
    <div class="text-center">
        <h1 class="text-center">Assigned Courses</h1>
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
                            <a href="{{ route('department_course_wise_students_view', ['instructor_id' => $assigned_course->instructor->id, 'department_id' => $assigned_course->course->department_id, 'course_id' => $assigned_course->course_id]) }}"><button type="button" class="btn btn-outline-success">Enlisted Students</button></a>
                        </td>
                    </tr>     
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $assigned_courses->links() }}

@endsection