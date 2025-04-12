@extends('layouts.dashboard')

@push('title')
    <title>Index Dashboard</title>
@endpush

@section('main-section')

        <div id="content">

            <div class="admin">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @elseif ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            </div>

            <div class="card border-0 dashboard-table table-content">
                <div class="card-header">
                    <h5 class="card-title text-center">Assigned Courses</h5>
                    <h6 class="card-subtitle text-center text-muted">
                        Assigned Courses For you
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table">
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
                                        <a href="{{ route('exams.create', $assigned_course->id) }}"><button type="button" class="btn btn-outline-success">Add Exam</button></a>
                                        <a href="{{ route('department_course_wise_students_view', ['instructor_id' => $assigned_course->instructor->id, 'department_id' => $assigned_course->course->department_id, 'course_id' => $assigned_course->course_id]) }}"><button type="button" class="btn btn-outline-secondary">Students</button></a> 
                                    </td>
                                </tr>     
                            @endforeach
                        </tbody>
                    </table>
                    {{ $assigned_courses->links() }}
                    <br>
                    <div class="card-header">
                        <h5 class="card-title text-center">View Exams</h5>
                        <h6 class="card-subtitle text-center text-muted">
                            Exams Created by You
                        </h6>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Course Name</th>
                                <th scope="col">Exam Title</th>
                                <th scope="col">Department</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Exam Type</th>
                                <th scope="col">Marks</th>
                                <th scope="col">Instructor</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                                <tr>
                                    <th scope="row">{{ $exam->course->name }}</th>
                                    <td>{{ $exam->exam_title }}</td>
                                    <td>{{ $exam->course->department->name }}</td>
                                    <td>{{ $exam->semester->name }}</td>
                                    <td>
                                        @if ($exam->exam_type == \App\Models\Exam::EXAM_TYPE_MID)
                                            Mid-Exam
                                        @elseif ($exam->exam_type == \App\Models\Exam::EXAM_TYPE_QUIZ)
                                            Quiz
                                        @elseif ($exam->exam_type == \App\Models\Exam::EXAM_TYPE_VIVA)
                                            Viva
                                        @elseif ($exam->exam_type == \App\Models\Exam::EXAM_TYPE_FINAL)
                                            Final-Exam
                                        @else
                                            Null
                                        @endif
                                    </td>
                                    <td>{{ $exam->marks }}</td>
                                    <td>{{ $exam->instructor->username }}</td>
                                    <td> 
                                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                            <a href="{{ route('exams.edit', $exam->id) }}"><button type="submit" class="btn btn-info p-3">Edit</button></a>
                                            <form action="{{ route('exams.delete', $exam->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger p-3">Delete</button>
                                            </form>
                                            <a href="{{ route('marks.create', $exam->id) }}"><button type="submit" class="btn btn-success p-1">Add Marks</button></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $exams->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection


