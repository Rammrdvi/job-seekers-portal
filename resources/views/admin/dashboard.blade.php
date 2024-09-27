@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    
    <!-- Search Form -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search by name, email, or job location">
    </div>
    
    <!-- Data Table -->
    <table class="table" id="jobSeekerTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Experience</th>
                <th>Job Location</th>
                <th>Photo</th>
                <th>Resume</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobSeekers as $jobSeeker)
                <tr>
                    <td>{{ $jobSeeker->id }}</td>
                    <td>{{ $jobSeeker->name }}</td>
                    <td>{{ $jobSeeker->email }}</td>
                    <td>{{ $jobSeeker->phone }}</td>
                    <td>{{ $jobSeeker->experience }}</td>
                    <td>{{ $jobSeeker->job_location }}</td>
                    <td>
                        <img src="{{ asset('storage/photos/' . $jobSeeker->photo) }}" alt="{{ $jobSeeker->name }}" style="width:50px; height:50px;" data-bs-toggle="modal" data-bs-target="#photoModal{{ $jobSeeker->id }}"/>
                    </td>
                    <td><a href="{{ asset('storage/resumes/' . $jobSeeker->resume) }}">View Resume</a></td>
                    <td>
                        <form action="{{ route('job_seekers.photo.delete', $jobSeeker->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this job seeker?');">Delete</button>
                        </form>
                     
                    </td>
                </tr>

                <!-- Modal for Photo View -->
                <div class="modal fade" id="photoModal{{ $jobSeeker->id }}" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="photoModalLabel">{{ $jobSeeker->name }}'s Photo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('storage/photos/' . $jobSeeker->photo) }}" alt="{{ $jobSeeker->name }}" class="img-fluid"/>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <div class="mb-3">
    <a href="{{ route('job_seekers.deleted') }}" class="btn btn-secondary">View Deleted Job Seekers</a>
</div>

</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('jobSeekerTable');
        const tableRows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        searchInput.addEventListener('keyup', function() {
            const query = searchInput.value.toLowerCase();
            Array.from(tableRows).forEach(row => {
                const cells = row.getElementsByTagName('td');
                let isVisible = false;

                Array.from(cells).forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(query)) {
                        isVisible = true;
                    }
                });

                row.style.display = isVisible ? '' : 'none';
            });
        });
    });
</script>
@endsection
@endsection
