<?php

namespace App\Http\Controllers;

use App\Models\AppliedJob;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Fetch job posts
        $jobPosts = JobPost::with('city')->get();

        // Fetch applied jobs for the logged-in user
        $appliedJobs = AppliedJob::where('user_id', Auth::id())->get();

        // Optionally, filter job posts if there's a search query
        if ($request->filled('search')) {
            $jobPosts = $jobPosts->filter(function ($jobPost) use ($request) {
                return str_contains($jobPost->title, $request->search) || 
                       str_contains($jobPost->city->name ?? '', $request->search);
            });
        }

        return view('home', compact('jobPosts', 'appliedJobs'));
    }
}
