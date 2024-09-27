@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Shortlisted Candidates') }}</div>

                <div class="card-body">
                    @if ($shortlistedJobs->isEmpty())
                        <div class="alert alert-info" role="alert">
                            No candidates have been shortlisted yet.
                        </div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Resume</th>
                                    <th>Photo</th>
                                    <th>Job Title</th>
                                    <th>City</th>
                                    <th>Shortlisted On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shortlistedJobs as $appliedJob)
                                    <tr>
                                        <td>{{ $appliedJob->user->name }}</td>
                                        <td>{{ $appliedJob->user->email }}</td>
                                        <td>{{ $appliedJob->user->phone }}</td>
                                        <td>
                                            @if ($appliedJob->user->resume)
                                                <a href="{{ asset('storage/resumes/' . $appliedJob->user->resume) }}" target="_blank">View Resume</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if ($appliedJob->user->photo)
                                                <img src="{{ asset('storage/' . $appliedJob->user->photo) }}" alt="User Photo" style="width: 50px; height: 50px; border-radius: 50%;">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ $appliedJob->jobPost->title }}</td>
                                        <td>{{ $appliedJob->jobPost->city->name ?? 'N/A' }}</td>
                                        <td>{{ $appliedJob->updated_at->format('d-m-Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
