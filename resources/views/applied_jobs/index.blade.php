@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                                    <th>Job Title</th>
                                    <th>City</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appliedJobs as $appliedJob)
                                    <tr>
                                        <td>{{ $appliedJob->jobPost->title }}</td>
                                        <td>{{ $appliedJob->jobPost->city->name ?? 'N/A' }}</td>
                                        <td>
                                            @if ($appliedJob->shortlisted)
                                                <span class="text-success">Your resume is shortlisted!</span>
                                            @else
                                                <span class="text-warning">Pending</span>
                                            @endif
                                        </td>
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
