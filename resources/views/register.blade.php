@extends('layouts.form')

@push('title')
    <title>Create Users</title>
@endpush

@section('main-section')
    <h2 class="text-center">Create User</h2>
    <form action="{{ route('users.register') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <label for="email" class="input-group-text">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group mb-3">
            <label for="username" class="input-group-text">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}">
            @error('username')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group mb-3">
            <label for="registration_number" class="input-group-text">Registration Number</label>
            <input type="number" name="registration_number" class="form-control" id="registration_number" value="{{ old('registration_number') }}">
            @error('registration_number')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group mb-2">
            <label for="password" class="input-group-text">Password</label>
            <input type="password" name="password" class="form-control" id="password">
            <p class="fs-6 text-warning">Note: Password must be minimum 8 characters containing uppercase, lowercase letters, numbers and special characters</p>
            @error('password')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group mb-3">
            <label for="password_confirmation" class="input-group-text">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
        </div>
        <div class="input-group mb-3">
            <label for="user_type" class="input-group-text col-4">User Type</label><br>
            <select name="user_type" id="user_type" class="col-6">
                <option value="1">Admin</option>
                <option value="2">Instructor</option>
                <option value="3">Student</option>
            </select>
            @error('user_type')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group mb-3">
            <label for="contact_no" class="input-group-text">Contact Number</label><br/>
            <input id="phonenum" class="col-6" name="phone_number" type="tel" pattern="^\d{5}\d{6}$" placeholder="(format: xxxxxxxxxxx):" required >
            @error('phone_number')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary text-center">Submit</button>
        </div>    
    </form>
@endsection