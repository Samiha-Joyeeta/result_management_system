@extends('layouts.view')

@push('title')
    <title>Course Marks For Various Students</title>
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

    <h3 class="text-center">Marks of Students</h3>

    <form action="{{ route('marks.instructor_view') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by exam title" value="{{ request('search') }}">
            </div>

            <div class="col-md-1">
                <button type="submit" class="btn btn-dark">Search</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-hover instructor-table">
        <thead>
            <tr>
                <th scope="col">Student's Name</th>
                <th scope="col">Registration Number</th>
                <th scope="col">Department</th>
                <th scope="col">Session</th>
                <th scope="col">Course</th>
                <th scope="col">Exam Title</th>
                <th scope="col">Exam Type</th>
                <th scope="col">Marks</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($marks as $mark)
                <tr>
                    <th scope="row">{{ $mark->student->user->username }}</th>
                    <td>{{ $mark->student->user->registration_number }}</td>
                    <td>{{ $mark->student->department->name }}</td>
                    <td>{{ $mark->student->session }}</td>
                    <td>{{ $mark->course->name }}</td>
                    <td>{{ $mark->exam->exam_title }}</td>
                    <td>
                        @if ($mark->exam->exam_type == App\Models\Exam::EXAM_TYPE_MID)
                                Mid exam
                        @elseif (($mark->exam->exam_type == App\Models\Exam::EXAM_TYPE_QUIZ))
                            Quiz
                        @elseif (($mark->exam->exam_type == App\Models\Exam::EXAM_TYPE_VIVA))
                            Viva
                        @elseif (($mark->exam->exam_type == App\Models\Exam::EXAM_TYPE_FINAL))
                            Final exam
                        @else
                            Null
                        @endif
                    </td>
                    <td>{{ $mark->marks }}</td>
                    <td class="btn-group gap-2" role="group" aria-label="Basic example">
                        <a href=""
                        class="btn btn-info update_marks_form"
                        data-bs-toggle="modal" 
                        data-bs-target="#updateModal"
                        data-id="{{ $mark->id }}",
                        data-marks="{{ $mark->marks }}"
                        >Edit
                        </a>
                        <a href="" class="delete_marks"  data-id="{{ $mark->id }}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $marks->links() }}
    
    @include('marks.edit_modal')
    @include('marks.marks_js')
@endsection