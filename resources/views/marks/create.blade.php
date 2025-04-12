@extends('layouts.form_template_2')

@push('title')
    <title>Add Exam Marks</title>
@endpush

@section('main-section')

    <h2 class="text-center">Add Exam Marks</h2>
    <form action="{{ route('marks.store') }}" method="POST"  class="row g-3">
        @csrf
        <div class="col-md-6">
        <label for="course_id" class="form-label">Course</label>
        <input type="hidden" name="course_id" class="form-control" id="course_id" value="{{ $exam->course->id }}">
        <input type="text" name="course" class="form-control" id="course_id" value="{{ $exam->course->name }}" readonly>
        @error('course_id')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        </div>
        <div class="col-md-6">
            <label for="exam_type" class="form-label mb-3">Exam Type</label><br>
            <span class="mt-2 border border-dark p-2 exam-type">
                @if ($exam->exam_type == \App\Models\Exam::EXAM_TYPE_MID)
                    Mid-Exam
                @elseif ($exam->exam_type == \App\Models\Exam::EXAM_TYPE_QUIZ)
                    Quiz
                @elseif ($exam->exam_type == \App\Models\Exam::EXAM_TYPE_VIVA)
                    Viva
                @elseif ($exam->exam_type == \App\Models\Exam::EXAM_TYPE_FINAL)
                    Final-Exam
                @else
                    ""
                @endif
            </span>
            @error('exam_type')
                <p class="text-danger">{{ $message }}
            @enderror
        </div>
        <div class="col-md-6">
            <label for="exam" class="form-label">Exam</label>
            <input type="hidden" name="exam_id" class="form-control" id="exam" value="{{ $exam->id }}">
            <input type="text" name="exam" class="form-control" id="exam" value="{{ $exam->exam_title }}" readonly>
            @error('exam_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="department_id" class="form-label">Department</label>
            <input type="hidden" name="department_id" class="form-control" id="department_id" value="{{ $exam->department->id }}">
            <input type="text" name="department" class="form-control" id="department_id" value="{{ $exam->department->name }}" readonly>
            @error('department_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="semester" class="form-label">Semester</label>
            <input type="hidden" name="semester_id" class="form-control" id="semester" value="{{ $exam->semester->id }}">
            <input type="text" name="semester" class="form-control" id="semester" value="{{ $exam->semester->name }}" readonly>
            @error('semester')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="student" class="form-label">Student</label>
            <select name="student_id" id="student" class="form-select">
                @foreach ($students as $student)
                    <option value="{{ $student->profile->id }}">{{ $student->username }} - {{ $student->profile->registration_number }}</option>
                @endforeach
                @error('student')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </select>
        </div>
        <div class="col-md-6">
            <label for="marks" class="form-label">Marks</label>
            <input type="number" name="marks" class="form-control" id="marks">
            @error('marks')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-dark text-center">Submit</button>
        </div>    
    </form>
    
@endsection