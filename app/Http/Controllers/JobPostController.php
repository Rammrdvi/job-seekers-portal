<?php
// app/Http/Controllers/JobPostController.php
namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AppliedJob;


class JobPostController extends Controller
{
    public function index()
    {
        $jobPosts = JobPost::with('city')->get();
        return view('job_posts.index', compact('jobPosts'));
    }

    public function create()
    {
        $cities = City::all();
        return view('job_posts.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'salary' => 'required|numeric',
            'city_id' => 'required|exists:cities,id',
        ]);

        JobPost::create($request->all());
        return redirect()->route('job_posts.index');
    }



    public function edit(JobPost $jobPost)
    {
        $cities = City::all();
        return view('job_posts.edit', compact('jobPost', 'cities'));
    }

    // Update method to handle form submission
    public function update(Request $request, JobPost $jobPost)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'salary' => 'required|numeric',
            'city_id' => 'required|exists:cities,id',
        ]);

        // Update the job post
        $jobPost->update($request->all());

        // Redirect to the job post listing page with a success message
        return redirect()->route('job_posts.index')->with('success', 'Job post updated successfully.');
    }

    // app/Http/Controllers/JobPostController.php
public function destroy(JobPost $jobPost)
{
    // Soft delete the job post
    $jobPost->delete();

    return redirect()->route('job_posts.index')->with('success', 'Job post deleted successfully.');
}

// Get only soft-deleted job posts
public function trashed()
{
    $trashedJobPosts = JobPost::onlyTrashed()->get(); // Only soft-deleted job posts
    return view('job_posts.trashed', compact('trashedJobPosts'));
}

public function restore($id)
{
    $jobPost = JobPost::withTrashed()->find($id);
    $jobPost->restore();

    return redirect()->route('job_posts.index')->with('success', 'Job post restored successfully.');
}


public function apply(Request $request, $jobPostId)
{
    // Check if the user is authenticated
    if (!Auth::check()) {
        return redirect()->route('login')->with('status', 'You must be logged in to apply for jobs.');
    }

    // Check if the user has already applied for this job
    if (AppliedJob::where('user_id', Auth::id())->where('job_post_id', $jobPostId)->exists()) {
        return redirect()->back()->with('status', 'You have already applied for this job.');
    }

    // Create a new application
    AppliedJob::create([
        'user_id' => Auth::id(),
        'job_post_id' => $jobPostId,
    ]);

    return redirect()->back()->with('status', 'You have successfully applied for the job.');
}


}

