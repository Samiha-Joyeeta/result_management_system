@extends('layouts.view')

@push('title')
    <title>Course List</title>
@endpush

@section('main-section')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="card position-absolute" style="width: 30rem;">
                <div class="card-body"> 
                    <h3 class="text-center">Add New Course</h3>
                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <label for="name" class="input-group-text">Name</label>
                            <input type="text" name="name" class="form-control" id="name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <label for="department_id" class="input-group-text">Department</label>
                            <select name="department_id" id="department_id" class="form-select">
                                @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <label for="credit" class="input-group-text">credit</label>
                            <input type="number" name="credit" class="form-control" id="credit" min="0.75" max="4" step="0.25">
                            @error('credit')
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

    <div class="view-courses">
    </div>
     
    <div class="text-center">
        <h1 class="text-center">All Courses</h1>

        <form action="{{ route('courses.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by course or department" value="{{ request('search') }}">
                </div>
    
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark">Search</button>
                </div>
            </div>
        </form>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">Status</th>
                    <th scope="col">Credit</th>
                    <th scope="col">Created_by</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <th scope="row">{{ $course->id }}</th>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->department->name }}</td>
                        <td>
                            @if ($course->status == \App\Models\Course::COURSE_STATUS_INACTIVE)
                                INACTIVE
                            @elseif ($course->status == \App\Models\Course::COURSE_STATUS_ACTIVE)
                                ACTIVE
                            @endif
                        </td>
                        <td>{{ $course->credit }}</td>
                        <td>Admin</td>
                        <td> 
                            <div class="btn-group gap-2" role="group" aria-label="Basic example">
                                <a href="{{ route('courses.edit', $course->id) }}"><button type="submit" class="btn btn-info">Edit</button></a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
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

    {{ $courses->links() }}

@endsection