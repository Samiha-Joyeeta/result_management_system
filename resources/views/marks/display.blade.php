@extends('layouts.view')

@push('title')
    <title>Marks & Result</title>
@endpush

@section('main-section')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
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
            </tr>
        </thead>
        <tbody>  
            <tr>
                <th scope="row">{{ $student->id }}</th>
                    <td>{{ $student->user->username }}</td>
                    <td>{{ $student->registration_number }}</td>
                    <td>{{ $student->department->name }}</td>
                    <td>{{ $student->session }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <h4 class="text-center">Marks & Result</h4>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Semester</th>
                <th scope="col">Course</th>
                <th scope="col">Exam Title</th>
                <th scope="col">Exam Type</th>
                <th scope="col">Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($marks as $semester_id => $semesterMarks)
                    <tr>
                        <th rowspan="{{ $rowspans[$semester_id] }}">{{  $semesterMarks[0]->semester->name }}</th>

                        @foreach ($semesterMarks as $mark)
                        <tr>
                            <td colspan="1">
                                {{ $mark->course->name }}
                            </td>
                            <td>
                                {{ $mark->exam->exam_title }}
                            </td>
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
                            <td>
                                {{ $mark->marks }}
                            </td>
                        </tr>
                        @endforeach
                    </tr>
            @endforeach
        </tbody>
    </table>
@endsection