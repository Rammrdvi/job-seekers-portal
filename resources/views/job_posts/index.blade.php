@extends('layouts.admin')

@section('content')
<h1>Job Posts</h1>

<!-- Create New Job Button -->
<div class="mb-3">
    <a href="{{ route('job_posts.create') }}" class="btn btn-success">Create New Job</a>
</div>

<!-- Search Bar -->
<div class="mb-3">
    <input type="text" id="search" class="form-control" placeholder="Search Job Posts..." onkeyup="searchTable()">
</div>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Salary</th>
            <th>City</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="jobTableBody">
        @foreach ($jobPosts as $jobPost)
        <tr>
            <td>{{ $jobPost->title }}</td>
            <td>{{ $jobPost->description }}</td>
            <td>{{ $jobPost->salary }}</td>
            <td>{{ $jobPost->city->name }}</td>
            <td>
                <a href="{{ route('job_posts.edit', $jobPost->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('job_posts.destroy', $jobPost->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    function searchTable() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const tableRows = document.querySelectorAll('#jobTableBody tr');

        tableRows.forEach(row => {
            const title = row.cells[0].textContent.toLowerCase();
            const description = row.cells[1].textContent.toLowerCase();
            const city = row.cells[3].textContent.toLowerCase();

            // Check if the search term matches any of the fields
            if (title.includes(searchInput) || description.includes(searchInput) || city.includes(searchInput)) {
                row.style.display = ''; // Show the row
            } else {
                row.style.display = 'none'; // Hide the row
            }
        });
    }
</script>

@endsection
