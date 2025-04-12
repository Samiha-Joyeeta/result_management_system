@extends('layouts.view')

@push('title')
    <title>Your Profile</title>
@endpush

@section('main-section')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <h1 class="text-center">Your Profile</h1>
    <div class="col-12"> <a href="{{ route('profile.edit', $profile->id) }}" class="btn btn-info"> Edit Profile </a> </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Middle Name</th>
                <th scope="col">last Name</th>
                <th scope="col">Department</th>
                <th scope="col">Session</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{ $profile->id }}</th>
                <td>{{ $profile->first_name }}</td>
                <td>{{ $profile->middle_name }}</td>
                <td>{{ $profile->last_name }}</td>
                <td>{{ isset($profile->department->name) ? $profile->department->name  : 'Null' }}</td>
                <td>{{ isset($profile->session) ? $profile->session  : 'Null' }}</td>
            </tr>     
        </tbody>
    </table>
    
@endsection