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
                        <a href="{{ route('instructor_wise_assigned_course_view', $user->id) }}"><button type="button" class="btn btn-success">Assigned Courses</button></a>
                    </td>
                </tr>     
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

@endsection
