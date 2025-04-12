<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4>Result Management System</h4>
        </div>

        @if (auth()->user()->user_type == \App\Models\User::USER_TYPE_ADMIN)
            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="{{ route('users.create') }}">Create User</a>
                </li>
                <li>
                    <a href="{{ route('user.view') }}">View All Users</a>
                </li>
                <li>
                    <a href="{{ route('departments.create') }}">Create Department</a>
                </li>
                <li>
                    <a href="{{ route('departments.index') }}">Department List</a>
                </li>
                <li>
                    <a href="{{ route('semesters.create') }}">Create Semester</a>
                </li>
                <li>
                    <a href="{{ route('semesters.index') }}">Semester List</a>
                </li>
                <li>
                    <a href="{{ route('courses.index') }}">See Course List</a>
                </li>
                <li>
                    <a href="{{ route('courses.create') }}">Create Course</a>
                </li>
                <li>
                    <a href="{{ route('assigned_courses.create') }}">Assign Courses</a>
                </li>
                <li>
                    <a href="{{ route('assigned_courses.index') }}">View Assigned Courses</a>
                </li>
                <li>
                    <a href="{{ route('exams.index') }}">View Exams</a>
                </li>
            </ul>     
        @elseif (auth()->user()->user_type == \App\Models\User::USER_TYPE_INSTRUCTOR)
            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('instructor.dashboard') }}">Home</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="">See Your Profile</a>
                </li>
                <li>
                    <a href="">Edit Your profile</a>
                </li>
            </ul>
        @elseif (auth()->user()->user_type == \App\Models\User::USER_TYPE_STUDENT)
            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('student.dashboard') }}">Home</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="">See Your Profile</a>
                </li>
                <li>
                    <a href="">Edit Your profile</a>
                </li>
            </ul>
        @endif

    </nav>