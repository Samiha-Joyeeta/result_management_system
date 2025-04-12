@extends('layouts.dashboard')

@push('title')
    <title>Index Dashboard</title>
@endpush

@section('main-section')

        <div id="content">
            
            <div class="admin">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @elseif ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            </div>

            <div class="row row-cols-1 row-cols-md-3 g-4 p-5">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa-solid fa-building-user"></i>
                            <h5 class="card-title">Departments</h5>
                            <p class="card-text">
                                Each of our departments is dedicated to fostering excellence in education, research, and innovation. With a commitment to preparing students for real-world challenges, we offer a range of disciplines led by expert faculty who are leaders in their fields.
                            </p>
                            <p class="text-success">Number of Departments: {{ $departmentCount }} </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa-solid fa-user-graduate"></i>
                            <h5 class="card-title">Students</h5>
                            <p class="card-text">
                                We have very talented students enrolled in our university.
                                The academic journey of students is made easier with our dedicated department offerings and course materials.
                                Students can see their result and marks achieved in each course, each semester.
                            </p>
                            <p class="text-success">Number of Current Students: {{ $studentCount }} </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa-solid fa-person-chalkboard"></i>
                            <h5 class="card-title">Instructors</h5>
                            <p class="card-text">
                               The platform is designed to help our student-friendly instructors manage their exams, add courses and marks as well as engage with students. The system provides everything they need to make their teaching experience efficient and effective.
                            </p>
                            <p class="text-success">Total number of instructors: {{ $instructorCount }} </p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa-solid fa-user-tie"></i>
                            <h5 class="card-title">Admins</h5>
                            <p class="card-text">
                                Admins have complete control over the management and maintenance of the university’s online platform. From updating course information and faculty details to managing user access, our system is designed to make your administrative tasks efficient and secure.
                            </p>
                            <p class="text-success">Total number of admins: {{ $adminCount }} </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-0 dashboard-table table-content-admin">
                <div class="card-header">
                    <h5 class="card-title">Latest User Table</h5>
                    <h6 class="card-subtitle text-muted">
                        The table shows latest 10 users:
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">Registration_number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone number</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Status</th>
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
                            </tr>     
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
