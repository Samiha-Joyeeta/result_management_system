@extends('layouts.view')

@push('title')
    <title>Enlisted students</title>
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

    <h3 class="text-center">Enlisted students</h3>
    <span class="instructor"><strong>Instructor : </strong>{{ $instructor->username }}</span><br>
    <span class="instructor"><strong>Department : </strong>{{ $department->name }}</span><br>
    <span class="instructor"><strong>Course : </strong>{{ $course->name }}</span><br>
    <br>
    <form action="{{ route('department_course_wise_students_view', [$instructor->id, $department->id, $course->id]) }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Search by students name or registration number" value="{{ request('search') }}">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-dark">Search</button>
            </div>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Registration Number</th>
                <th scope="col">Department</th>
                <th scope="col">Session</th>
                <th scope="col">Result</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <th scope="row">{{ $student->user->username }}</th>
                    <td>{{ $student->registration_number }}</td>
                    <td>{{ $student->department->name }}</td>
                    <td>{{ $student->session }}</td>
                    <td>{{ $student->result->final_cgpa }}</td>
                    <td> 
                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                            <a href="{{ route('results.show', $student->id) }}"><button type="submit" class="btn btn-success">All Results</button></a>
                            <a href="{{ route('marks.view', $student->id) }}"><button type="submit" class="btn btn-secondary">All Marks</button></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $students->links() }}

@endsection