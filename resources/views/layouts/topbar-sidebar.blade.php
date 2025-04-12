<div class="slider">
    <nav class="navbar navbar-expand-lg topbar">
        <div class="container-fluid top-bar">
        <div class="web-header navbar-nav me-auto mb-2 mb-lg-0">
            <header>  
                <p class="fs-6"><img src="{{ asset('images\graduation-logo.png') }}" class="navbar-logo" alt="logo" /> Result Management System</p>
            </header>
        </div>
        <div class="ms-auto mb-2 mb-lg-0">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
        <li class="nav-item">
            <p class="fs-6 welcome-messages"> Welcome to 

                @if (auth()->user()->user_type == \App\Models\User::USER_TYPE_ADMIN)
                    admin
                @elseif (auth()->user()->user_type == \App\Models\User::USER_TYPE_INSTRUCTOR)
                    instructor
                @elseif (auth()->user()->user_type == \App\Models\User::USER_TYPE_STUDENT)
                    student
                @endif
                
                dashboard, {{ auth()->user()->username }}</p>
        </li>
    </ul>
    <ul class="navbar-nav profile-menu"> 
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="profile-pic">
                <img src="{{ asset('images/profile-icon.jpg') }}" alt="Profile Picture">
            </div>
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @if (auth()->user()->user_type != \App\Models\User::USER_TYPE_ADMIN)
                <li>
                    <a class="dropdown-item" href="{{ route('profile.index', $profile->id) }}"><i class="fa-solid fa-user fa-fw"></i> View Profile</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit', $profile->id) }}"><i class="fas fa-sliders-h fa-fw"></i> Edit Profile</a>
                </li>
            @endif
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('users.logout') }}"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a></li>
        </ul>
        </li>
    </ul>
    </div>
    </div>
    </div>
    </div>
    </nav>


    <div class="side-bar">

        @if (auth()->user()->user_type == \App\Models\User::USER_TYPE_ADMIN)
            <ul class="list1">
                <li> <a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('user.view') }}">Users</a></li>
                <li>
                    <a href="{{ route('instructor') }}">Instructors</a>
                </li>
                <li>
                    <a href="{{ route('departments.index') }}">Departments</a>
                </li>
                <li>
                    <a href="{{ route('semesters.index') }}">Semesters</a>
                </li>
                <li>
                    <a href="{{ route('courses.index') }}">Courses</a>
                </li>
                <li>
                    <a href="{{ route('assigned_courses.index') }}">Assigned Courses</a>
                </li>
                <li>
                    <a href="{{ route('exams.index') }}">View Exams</a>
                </li>
                <li>
                    <form action="{{ route('results.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="link-button">Update Result</button>
                    </form>
                </li>
                <li>
                    <a href="{{ route('results.index') }}">View Results</a>
                </li>
            </ul>
        @elseif (auth()->user()->user_type == \App\Models\User::USER_TYPE_INSTRUCTOR)
            <ul class="list1">
                <li>
                    <a href="{{ route('instructor.dashboard') }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('marks.instructor_view') }}">Course Marks</a>
                </li>
                <li>
                    <a href="{{ route('results.index') }}">View Results</a>
                </li>
            </ul>
        @elseif (auth()->user()->user_type == \App\Models\User::USER_TYPE_STUDENT)
            <ul class="list1">
                <li>
                    <a href="{{ route('student.dashboard') }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('results.show', $profile->id) }}">View Result</a>
                </li>
                <li>
                    <a href="{{ route('marks.view', $profile->id) }}">View Marks</a>
                </li>
            </ul>
        @endif
        
    </div>