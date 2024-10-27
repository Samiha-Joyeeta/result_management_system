@extends('layouts.view')

@push('title')
    <title>Users List</title>
@endpush

@section('main-section')
    <h1 class="text-center">All Users</h1>
    <div class="col-12"> <a href=" " class="btn btn-info"> Add New </a> </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">Username</th>
                <th scope="col">Registration_number</th>
                <th scope="col">Email</th>
                <th scope="col">Phone number</th>
                <th scope="col">User Type</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->registration_number }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number}}</td>
                    <td>{{ $user->user_type}}</td>
                    <td>{{ $user->status}}</td>
                    <td class="btn-group gap-2" role="group" aria-label="Basic example">
                        <a href=""><button type="submit" class="btn btn-info">Edit</button></a>
                        <form action="" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>     
            @endforeach
        </tbody>
    </table>
@endsection