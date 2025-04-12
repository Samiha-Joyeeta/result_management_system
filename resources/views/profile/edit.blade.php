@extends('layouts.form')

@push('title')
    <title>Update Profile</title>
@endpush

@section('main-section')
    <h2 class="text-center">Update Profile</h2>
    <form action="{{ route('profile.update', $profile->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="input-group mb-3">
            <label for="firstname" class="input-group-text">First Name</label>
            <input type="text" name="first_name" class="form-control" id="firstname" value={{  isset($profile->first_name) ? $profile->first_name  : ' ' }}>
            @error('firstname')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group mb-3">
            <label for="middlename" class="input-group-text">Middle name</label>
            <input type="text" name="middle_name" class="form-control" id="middlename" value={{  isset($profile->middle_name) ? $profile->middle_name  : ' ' }}>
            @error('middlename')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group mb-3">
            <label for="lastname" class="input-group-text">Last name</label>
            <input type="text" name="last_name" class="form-control" id="lastname" value={{  isset($profile->last_name) ? $profile->last_name  : ' '  }}>
            @error('lastname')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-dark text-center">Submit</button>
        </div>    
    </form>
@endsection