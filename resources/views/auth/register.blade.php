@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="row mb-3">
    <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

    <div class="col-md-6">
        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>

        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


                        <!-- Experience (in Years) -->
                        <div class="row mb-3">
                            <label for="experience" class="col-md-4 col-form-label text-md-end">{{ __('Experience (in Years)') }}</label>
                            <div class="col-md-6">
                                <input id="experience" type="number" class="form-control @error('experience') is-invalid @enderror" name="experience" value="{{ old('experience') }}" required>
                                @error('experience')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Notice Period (in Days) -->
                        <div class="row mb-3">
                            <label for="notice_period" class="col-md-4 col-form-label text-md-end">{{ __('Notice Period (in Days)') }}</label>
                            <div class="col-md-6">
                                <input id="notice_period" type="number" class="form-control @error('notice_period') is-invalid @enderror" name="notice_period" value="{{ old('notice_period') }}" required>
                                @error('notice_period')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Skills -->
                        <div class="row mb-3">
                            <label for="skills" class="col-md-4 col-form-label text-md-end">{{ __('Skills') }}</label>
                            <div class="col-md-6">
                                <textarea id="skills" class="form-control @error('skills') is-invalid @enderror" name="skills" required>{{ old('skills') }}</textarea>
                                @error('skills')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Job Location (Select) -->
                        <!-- Job Location (Select) -->
<div class="row mb-3">
    <label for="job_location" class="col-md-4 col-form-label text-md-end">{{ __('Job Location') }}</label>
    <div class="col-md-6">
        <select id="job_location" class="form-control @error('job_location') is-invalid @enderror" name="job_location" required>
            <option value="">Select Job Location</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
        @error('job_location')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


                        <!-- Resume (PDF upload) -->
                        <div class="row mb-3">
                            <label for="resume" class="col-md-4 col-form-label text-md-end">{{ __('Resume (PDF)') }}</label>
                            <div class="col-md-6">
                                <input id="resume" type="file" class="form-control @error('resume') is-invalid @enderror" name="resume" accept="application/pdf" required>
                                @error('resume')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Photo (Image upload) -->
                        <div class="row mb-3">
                            <label for="photo" class="col-md-4 col-form-label text-md-end">{{ __('Photo') }}</label>
                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" accept="image/*" required>
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
