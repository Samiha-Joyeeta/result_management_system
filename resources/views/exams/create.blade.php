@extends('layouts.form_template_2')

@push('title')
    <title>Create Exam</title>
@endpush

@section('main-section')

    <h2 class="text-center">Create Exam</h2>
    <form action="{{ route('exams.store') }}" method="POST"  class="row g-3">
        @csrf
        <div class="col-md-6">
            <label for="course_id" class="form-label">Course</label>
            <input type="hidden" name="course_id" class="form-control" id="course_id" value="{{ $assigned_course->course->id }}">
            <input type="text" name="course" class="form-control" id="course_id" value="{{ $assigned_course->course->name }}" readonly>
                @error('course_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
        </div>
        <div class="col-md-6">
            <label for="exam_title" class="form-label">Exam Title</label>
            <input type="text" name="exam_title" class="form-control" id="exam_title">
                @error('exam_title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
        </div>
        <div class="col-md-6">
            <label for="department_id" class="form-label">Department</label>
            <input type="hidden" name="department_id" class="form-control" id="department_id" value="{{ $assigned_course->course->department->id }}">
            <input type="text" name="department" class="form-control" id="department_id" value="{{ $assigned_course->course->department->name }}" readonly>
                @error('department_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
        </div>
        <div class="col-md-4">
            <label for="semester" class="form-label">Semester</label>
            <input type="hidden" name="semester_id" class="form-control" id="semester" value="{{ $assigned_course->semester->id }}">
            <input type="text" name="semester" class="form-control" id="semester" value="{{ $assigned_course->semester->name }}" readonly>
                @error('semester')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
        </div>
        <div class="col-md-2">
            <label for="exam_type" class="form-label">Exam Type</label>
            <select name="exam_type" id="exam_type" class="form-select">
                <option value="1">Mid</option>
                <option value="2">Quiz</option>
                <option value="3">Viva</option>
                <option value="4">Final</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="marks" class="form-label">Marks</label>
            <input type="number" name="marks" class="form-control" id="marks">
            @error('marks')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="instructor" class="form-label">Instructor</label>
            <input type="hidden" name="instructor_id" class="form-control" id="instructor" value="{{ $assigned_course->instructor->id }}">
            <input type="text" name="instructor" class="form-control" id="instructor" value="{{ $assigned_course->instructor->username }}" readonly>
            @error('instructor')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-dark text-center">Submit</button>
        </div>
    </form>

@endsection