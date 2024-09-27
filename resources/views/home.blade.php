@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <!-- Search Form (Client-side search using JavaScript) -->
                    <div class="mb-4">
                        <input type="text" id="jobSearchInput" class="form-control" placeholder="Search by job title or city">
                    </div>

                    <!-- Job Posts Table -->
                    <h5>Available Job Posts</h5>
                    <table class="table" id="jobPostsTable">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jobPosts as $jobPost)
                                @if (!$appliedJobs->contains('job_post_id', $jobPost->id))
                                    <tr>
                                        <td class="job-title">{{ $jobPost->title }}</td>
                                        <td class="job-city">{{ $jobPost->city->name ?? 'N/A' }}</td>
                                        <td>
                                            <form action="{{ route('job_posts.apply', $jobPost->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No job posts available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Link to Applied Jobs -->
                    <div class="mt-4">
                        <a href="{{ route('applied_jobs.index') }}" class="btn btn-secondary">View Applied Jobs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to filter the table -->
<script>
    document.getElementById('jobSearchInput').addEventListener('keyup', function() {
        // Get the input value and convert it to lowercase
        let searchValue = this.value.toLowerCase();
        
        // Get all the table rows in the job posts table
        let rows = document.querySelectorAll('#jobPostsTable tbody tr');

        // Loop through the rows and hide/show based on search input
        rows.forEach(function(row) {
            // Get the job title and city text from the current row
            let jobTitle = row.querySelector('.job-title').textContent.toLowerCase();
            let jobCity = row.querySelector('.job-city').textContent.toLowerCase();

            // Check if the search value matches either the job title or city
            if (jobTitle.includes(searchValue) || jobCity.includes(searchValue)) {
                row.style.display = ''; // Show the row
            } else {
                row.style.display = 'none'; // Hide the row
            }
        });
    });
</script>
@endsection
