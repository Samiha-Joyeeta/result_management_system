@extends('layouts.form')

@push('title')
    <title>Edit Department</title>
@endpush

@section('main-section')

    <h3 class="text-center">Edit Department</h3>
    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="input-group mb-3">
            <label for="name" class="input-group-text">Name</label>
            <input type="text" name="name" class="form-control" id="name"  value="{{ $department->name }}">
            @error('name')
            <div class="col-12"><p class="text-danger">{{ $message }}</p></div>
            @enderror
        </div>
        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-dark text-center">Submit</button>
        </div>    
    </form>

@endsection