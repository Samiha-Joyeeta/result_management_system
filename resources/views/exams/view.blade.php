@extends('layouts.view')

@push('title')
    <title>Exam List</title>
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

    <h1 class="text-center">Exam List</h1>

    <form action="{{ route('exams.index') }}" method="GET" class="mb-3">
        <div class="row">

            <div class="col-md-4">
                <select name="exam_type" class="form-control">
                    <option value="">Filter by Exam Type</option>
                    <option value="{{ \App\Models\Exam::EXAM_TYPE_MID }}">Mid-Exam</option>
                    <option value="{{ \App\Models\Exam::EXAM_TYPE_QUIZ }}">Quiz</option>
                    <option value="{{ \App\Models\Exam::EXAM_TYPE_VIVA }}">Viva</option>
                    <option value="{{ \App\Models\Exam::EXAM_TYPE_FINAL }}">Final Exam</option>
                </select>
            </div>

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
                            <a href="{{ route('exams.edit', $exam->id) }}"><button type="submit" class="btn btn-info">Edit</button></a>
                            <form action="{{ route('exams.delete', $exam->id) }}" method="POST">
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
    
    {{ $exams->links() }}

@endsection