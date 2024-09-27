@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required>
        </div>
        <div class="form-group">
            <label for="experience">Experience (in Years)</label>
            <input type="number" class="form-control" id="experience" name="experience" value="{{ old('experience', Auth::user()->experience) }}" required>
        </div>
        <div class="form-group">
            <label for="notice_period">Notice Period (in Days)</label>
            <input type="number" class="form-control" id="notice_period" name="notice_period" value="{{ old('notice_period', Auth::user()->notice_period) }}" required>
        </div>
        <div class="form-group">
            <label for="skills">Skills</label>
            <input type="text" class="form-control" id="skills" name="skills" value="{{ old('skills', Auth::user()->skills) }}" required>
        </div>
        <div class="form-group">
            <label for="job_location">Job Location</label>
            <input type="text" class="form-control" id="job_location" name="job_location" value="{{ old('job_location', Auth::user()->job_location) }}" required>
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" class="form-control" id="photo" name="photo">
            @if(Auth::user()->photo)
                <img src="{{ asset('storage/photos/' . Auth::user()->photo) }}" alt="Photo" style="width:100px; height:100px;">
            @endif
        </div>
        <div class="form-group">
            <label for="resume">Resume</label>
            <input type="file" class="form-control" id="resume" name="resume">
            @if(Auth::user()->resume)
                <a href="{{ asset('storage/resumes/' . Auth::user()->resume) }}" target="_blank">View Current Resume</a>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
