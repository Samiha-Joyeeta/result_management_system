<!DOCTYPE HTML>
<html>
<head>
<title>Side bar and Topbar</title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link href="{{ asset('css/sidetopbar.css') }}" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">


</head>
<body>

    <nav class="navbar navbar-expand-lg">
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
            <li><a class="dropdown-item" href="#"><i class="fas fa-sliders-h fa-fw"></i> Edit Profile</a></li>
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
                <li> <a href="{{ route('welcome') }}">Home</a></li>
                <li><a href="{{ route('users.create') }}">Create User </a></li>
                <li><a href="{{ route('user.view') }}">View  User</a></li>
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
            <ul class="list1">
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
            <ul class="list1">
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
        
	</div>
	
	<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script>
    <script src="{{ asset('js/script.js') }}"></script>

	</body>
</HTML>
