@extends('layouts.view')

@push('title')
    <title>Users List</title>
@endpush

@section('main-section')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="col-12"> <a class="btn btn-info" id="add-new-button"> Add New </a> </div>
    <div id="form-container pb-5 pt-5">
        @include('register')
    </div>
    <h1 class="text-center">All Users</h1>
    <form action="{{ route('user.view') }}" method="GET" class="mb-3">
        <div class="row">
            
            <div class="col-md-3">
                <select name="user_type" class="form-control">
                    <option value="">Filter by User Type</option>
                    <option value="{{ \App\Models\User::USER_TYPE_ADMIN }}">Admin</option>
                    <option value="{{ \App\Models\User::USER_TYPE_INSTRUCTOR }}">Instructor</option>
                    <option value="{{ \App\Models\User::USER_TYPE_STUDENT }}">Student</option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="order" class="form-control">
                    <option value="">Order by Creation Date</option>
                    <option value="asc">Oldest to Newest</option>
                    <option value="desc">Newest to Oldest</option>
                </select>
            </div>

            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by Username or Email" value="{{ request('search') }}">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-dark">Filter</button>
            </div>
        </div>
    </form>

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
                    <td>
                        @if ($user->user_type == \App\Models\User::USER_TYPE_ADMIN)
                            Admin
                        @elseif ($user->user_type == \App\Models\User::USER_TYPE_INSTRUCTOR)
                            Instructor
                        @elseif ($user->user_type == \App\Models\User::USER_TYPE_STUDENT)
                            Student
                        @endif
                    </td>
                    <td>
                        @if ($user->status == \App\Models\User::USER_STATUS_INACTIVE)
                            INACTIVE
                        @elseif ($user->status == \App\Models\User::USER_STATUS_ACTIVE)
                            ACTIVE
                        @endif
                    </td>
                    <td class="btn-group gap-2" role="group" aria-label="Basic example">
                        <a href=""
                        class="btn btn-info update_user_form"
                        data-bs-toggle="modal" 
                        data-bs-target="#updateModal"
                        data-id="{{ $user->id }}"
                        data-username="{{ $user->username }}"
                        data-email="{{ $user->email }}"
                        data-registration_number="{{ $user->registration_number }}"
                        data-phone_number="{{ $user->phone_number }}"
                        data-status="{{ $user->status }}"
                        data-user_type="{{ $user->user_type }}"
                        >Edit
                        </a>
                        <a href="" class="delete_user"  data-id="{{ $user->id }}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>     
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}

    @include('users.edit_modal')
    @include('users.users_js')

@endsection
