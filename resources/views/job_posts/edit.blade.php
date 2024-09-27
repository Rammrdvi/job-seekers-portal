@extends('layouts.admin')

@section('content')
<h1>Edit Job Post</h1>

<form action="{{ route('job_posts.update', $jobPost->id) }}" method="POST" class="mt-4">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $jobPost->title) }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $jobPost->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="salary" class="form-label">Salary:</label>
        <input type="number" name="salary" id="salary" class="form-control" value="{{ old('salary', $jobPost->salary) }}" required>
    </div>

    <div class="mb-3">
        <label for="city_id" class="form-label">City:</label>
        <select name="city_id" id="city_id" class="form-select" required>
            @foreach ($cities as $city)
            <option value="{{ $city->id }}" {{ $jobPost->city_id == $city->id ? 'selected' : '' }}>
                {{ $city->name }}
            </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Job Post</button>
    <a href="{{ route('job_posts.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
