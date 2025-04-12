@extends('layouts.view')

@push('title')
    <title>Results</title>
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

    <h1 class="text-center">Results</h1>
    
    <form action="{{ route('results.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <label for="min_cgpa" class="form-label">Minimum CGPA</label>
                <input type="number" step="0.25" name="min_cgpa" id="min_cgpa" class="form-control" placeholder="e.g 2.5" value="{{ request('min_cgpa') }}">
            </div>
            <div class="col-md-3">
                <label for="max_cgpa" class="form-label">Maximum CGPA</label>
                <input type="number" step="0.25" name="max_cgpa" id="max_cgpa" class="form-control" placeholder="e.g 4.0" value="{{ request('max_cgpa') }}">
            </div>
            <div class="col-md-2 mt-4 pt-2">
                <button type="submit" class="btn btn-dark">Search</button>
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Registration Number</th>
                <th scope="col">Department</th>
                <th scope="col">Session</th>
                <th scope="col">CGPA</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr>
                    <th scope="row">{{ $result->student_id }}</th>
                    <td>{{ $result->student->user->username }}</td>
                    <td>{{ $result->student->registration_number }}</td>
                    <td>{{ $result->student->department->name }}</td>
                    <td>{{ $result->student->session }}</td>
                    <td>{{ $result->final_cgpa }}</td>
                    <td> 
                        <div class="btn-group gap-2" role="group" aria-label="Basic example">
                            <a href="{{ route('results.show', $result->student_id) }}"><button type="submit" class="btn btn-success">All Results</button></a>
                            <a href="{{ route('marks.view', $result->student_id) }}"><button type="submit" class="btn btn-secondary">All Marks</button></a>
                            <form action="{{ route('results.delete',$result->student_id) }}" method="POST">
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

    {{ $results->links() }}

@endsection