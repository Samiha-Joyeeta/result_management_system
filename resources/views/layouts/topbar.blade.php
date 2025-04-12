<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <div class="navbar-nav me-auto mb-2 mb-lg-0">
            <p> <i class="fa-solid fa-user"></i> Welcome to 

            @if (auth()->user()->user_type == \App\Models\User::USER_TYPE_ADMIN)
                admin
            @elseif (auth()->user()->user_type == \App\Models\User::USER_TYPE_INSTRUCTOR)
                instructor
            @elseif (auth()->user()->user_type == \App\Models\User::USER_TYPE_STUDENT)
                student
            @endif
            
            dashboard, {{ auth()->user()->username }}</p>
        </div>
        <span class="navbar-text logout">
            <a href="{{ route('users.logout') }}">Logout</a>
        </span>
    </div>
    </div>
</nav>