@extends('layouts.form')

@push('title')
    <title>Login</title>
@endpush

@section('main-section')
    <h2 class="text-center">Login</h2>
    <form action="{{ route('users.loginMatch') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <label for="email" class="input-group-text"><i class="fa-solid fa-envelope"></i></label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email" value="{{ old('email') }}">
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group mb-3">
            <label for="password" class="input-group-text"><i class="fa-solid fa-lock"></i></label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter Your Password">
            @error('password')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary text-center">Submit</button>
        <div class="d-grid">
            <p class="mt-3"><a href="#" class="text-danger link-underline-light">Forgot Password?</a></p>
        </div>  
    </form>
@endsection