@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Deleted Job Seekers</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Experience</th>
                <th>Job Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deletedJobSeekers as $jobSeeker)
                <tr>
                    <td>{{ $jobSeeker->id }}</td>
                    <td>{{ $jobSeeker->name }}</td>
                    <td>{{ $jobSeeker->email }}</td>
                    <td>{{ $jobSeeker->phone }}</td>
                    <td>{{ $jobSeeker->experience }}</td>
                    <td>{{ $jobSeeker->job_location }}</td>
                    <td>
                        <form action="{{ route('job_seekers.restore', $jobSeeker->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Restore</button>
                        </form>
                        <form action="{{ route('job_seekers.forceDelete', $jobSeeker->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to permanently delete this job seeker?');">Permanent Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
