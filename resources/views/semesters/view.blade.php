@extends('layouts.view')

@push('title')
    <title>Semester List</title>
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

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="card position-absolute" style="width: 30rem;">
                <div class="card-body"> 
                    <h3 class="text-center">Add New Semester</h3>
                    <form action="{{ route('semesters.store') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <label for="name" class="input-group-text">Name</label>
                            <input type="text" name="name" class="form-control" id="name"  placeholder="Enter Semester Name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-dark text-center">Submit</button>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="view">
    </div>

    <div class="text-center">
        <h1 class="text-center">All Semesters</h1>

        <form action="{{ route('semesters.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by semester" value="{{ request('search') }}">
                </div>
    
                <div class="col-md-1">
                    <button type="submit" class="btn btn-dark">Search</button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created_by</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($semesters as $semester)
                    <tr>
                        <th scope="row">{{ $semester->id }}</th>
                        <td>{{ $semester->name }}</td>
                        <td>Admin</td>
                        <td> 
                            <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                <a href="{{ route('semesters.edit', $semester->id) }}"><button type="submit" class="btn btn-info">Edit</button></a>
                                <form action="{{ route('semesters.destroy', $semester->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>     
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $semesters->links() }}

@endsection