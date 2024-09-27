@extends('layouts.admin')

@section('content')
<h1>Trashed Job Posts</h1>

<!-- Search Bar -->
<div class="mb-3">
    <input type="text" id="search" class="form-control" placeholder="Search Trashed Job Posts..." onkeyup="searchTable()">
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
        @foreach ($trashedJobPosts as $jobPost)
        <tr>
            <td>{{ $jobPost->title }}</td>
            <td>{{ $jobPost->description }}</td>
            <td>{{ $jobPost->salary }}</td>
            <td>{{ $jobPost->city->name }}</td>
            <td>
                <form action="{{ route('job_posts.restore', $jobPost->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Restore</button>
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
