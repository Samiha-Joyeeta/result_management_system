@extends('layouts.view')

@push('title')
    <title>Marks & Result</title>
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

    <h3 class="text-center">Student Details</h3>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Registration Number</th>
                <th scope="col">Department</th>
                <th scope="col">Session</th>
                <th scope="col">Final CGPA</th>
            </tr>
        </thead>
        <tbody>  
            <tr>
                <th scope="row">{{ $result->student_id }}</th>
                    <td>{{ $result->student->user->username }}</td>
                    <td>{{ $result->student->registration_number }}</td>
                    <td>{{ $result->student->department->name }}</td>
                    <td>{{ $result->student->session }}</td>
                    <td>{{ $result->final_cgpa }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <h4 class="text-center">Marks & Result</h4>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Semester</th>
                <th scope="col">Courses</th>
                <th scope="col">Total Marks</th>
                <th scope="col">GPA</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gpaData as $student_id => $semesters)
                @foreach ($semesters as $semester_id => $data)
                    <tr>
                        <th scope="row">{{  $data['semester_name'] }}</th>
                        <td>
                            <ul>
                                @foreach ($data['courses'] as $course)
                                    <li>{{ $course['course_name'] }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @foreach ($data['courses'] as $course)
                                    <li>{{ $course['total_marks'] }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $data['gpa'] }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    
@endsection