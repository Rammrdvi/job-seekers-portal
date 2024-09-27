<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin Dashboard') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .sidebar {
            background-color: #f8f9fa;
        }
        .nav-link {
            color: #212529;
            padding: 10px 15px;
        }
        .nav-link:hover {
            background-color: #e9ecef;
        }
        .dropdown-menu {
            left: auto;
            right: 0;
        }
        .nav-link.active {
            background-color: #007bff;
            color: white;
        }
        .navbar-nav {
            align-items: center;
        }
        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Admin Dashboard') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}" href="{{ route('admin.home') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('job_posts.index') ? 'active' : '' }}" href="{{ route('job_posts.index') }}">Job Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('job_posts.create') ? 'active' : '' }}" href="{{ route('job_posts.create') }}">Create Job Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('job_posts.trashed') ? 'active' : '' }}" href="{{ route('job_posts.trashed') }}">Trashed Job Posts</a>
                        </li>

                        <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.applied_jobs.index') ? 'active' : '' }}" href="{{ route('admin.applied_jobs.index') }}">Applied Jobs</a>
    </li>

    <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('shortlist.view') ? 'active' : '' }}" href="{{ route('shortlist.view') }}">Shortlisted Users</a>
</li>

                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('password.change') }}">{{ __('Change Password') }}</a>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Edit Profile') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
                    <h1 class="h2">@yield('page_title')</h1>
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @yield('scripts')
</body>
</html>
