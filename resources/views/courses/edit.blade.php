@extends('layouts.form')

@push('title')
    <title>Edit Course</title>
@endpush

@section('main-section')

    <h3 class="text-center">Edit Course</h3>
    
    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="input-group mb-3">
            <label for="name" class="input-group-text">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $course->name }}">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group mb-3">
            <label for="department_id" class="input-group-text">Department</label>
            <select name="department_id" id="department_id" class="form-select">
                @foreach ($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
            @error('course_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group mb-3">
            <label for="status" class="input-group-text">Department</label>
            <select name="status" id="status" class="form-select">
                <option value="{{ \App\Models\Course::COURSE_STATUS_ACTIVE }}">Active</option>
                <option value="{{ \App\Models\Course::COURSE_STATUS_INACTIVE }}">Inactive</option>
            </select>
            @error('course_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group mb-3">
            <label for="credit" class="input-group-text">credit</label>
            <input type="number" name="credit" class="form-control" id="credit" min="0.75" max="4" step="0.25" value="{{ $course->credit }}">
            @error('credit')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary text-center">Submit</button>
        </div>    
    </form>
@endsection