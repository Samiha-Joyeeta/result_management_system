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

            <div class="card border-0 dashboard-table table-content">
                <div class="card-header">
                    <h5 class="card-title">Student Table</h5>
                    <h6 class="card-subtitle text-muted">
                        The table shows your enrolled courses:
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Enrolled Courses</th>
                                <th scope="col">Semester</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marks as $course_id => $courses)
                            <tr>
                                <th scope="row">{{ $courses[0]->course->name }}</th>
                                <td>{{ $courses[0]->semester->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection


