@extends('layouts.view')

@push('title')
    <title>Index Dashboard</title>
@endpush

@section('main-section')
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4>Result Management System</h4>
            </div>
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
                    <a href="#">View All Users</a>
                </li>
                <li>
                    <a href="">Contact</a>
                </li>
                <li>
                    <a href="{{ route('users.logout') }}">Logout</a>
                </li>
            </ul>
        </nav>
        <div id="content">
            <div class="admin">
                <p> <i class="fa-solid fa-user"></i> Welcome to admin dashboard, {{ auth()->user()->username }}</p>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
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
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa-solid fa-user-graduate"></i>
                            <h5 class="card-title">Students</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa-solid fa-person-chalkboard"></i>
                            <h5 class="card-title">Instructors</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <h5 class="card-title">Graduate Students</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-0 dashboard-table">
                <div class="card-header">
                    <h5 class="card-title">Basic Table</h5>
                    <h6 class="card-subtitle text-muted">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum ducimus, necessitatibus reprehenderit itaque!
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">FirstName</th>
                                <th scope="col">LastName</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

