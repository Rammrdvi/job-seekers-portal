@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Applied Jobs') }}</div>

                <div class="card-body">
                    @if ($appliedJobs->isEmpty())
                        <div class="alert alert-info" role="alert">
                            You have not applied for any jobs yet.
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
                                    <th>Applied On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appliedJobs as $appliedJob)
                                    <tr>
                                        <td>{{ $appliedJob->user->name }}</td>
                                        <td>{{ $appliedJob->user->email }}</td>
                                        <td>{{ $appliedJob->user->phone }}</td>
                                        <td>
                                            @if ($appliedJob->user->resume)
                                                <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#resumeModal{{ $appliedJob->id }}">View Resume</button>
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
                                        <td>{{ $appliedJob->created_at->format('d-m-Y') }}</td>
                                        <td>
                                        <form action="{{ route('shortlist', $appliedJob->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success btn-sm">Shortlist</button>
    </form>
                                        </td>
                                    </tr>

                                    <!-- Resume Modal -->
                                    <div class="modal fade" id="resumeModal{{ $appliedJob->id }}" tabindex="-1" aria-labelledby="resumeModalLabel{{ $appliedJob->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="resumeModalLabel{{ $appliedJob->id }}">Resume of {{ $appliedJob->user->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <iframe src="{{ asset('storage/resumes/' . $appliedJob->user->resume) }}" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
