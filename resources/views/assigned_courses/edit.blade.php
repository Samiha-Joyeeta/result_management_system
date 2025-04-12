@extends('layouts.form_template_2')

@push('title')
    <title>Assign Courses To Instructors</title>
@endpush

@section('main-section')

    <h3 class="text-center">Assign Courses To Instructors</h3>

    <form action="{{ route('assigned_courses.update', $assigned_course->id) }}" method="POST"  class="row g-3">
        @csrf
        @method('PUT')
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
        </select>
        @error('semester')
            <p class="text-danger">{{ $message }}</p>
        @enderror
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
    
@endsection