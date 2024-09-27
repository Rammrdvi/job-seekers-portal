<?php
namespace App\Http\Controllers;

use App\Models\AppliedJob;
use Illuminate\Support\Facades\Auth;

use App\Mail\ResumeShortlisted;
use Illuminate\Support\Facades\Mail;

class AppliedJobController extends Controller
{
    public function index()
    {
        $appliedJobs = AppliedJob::with('jobPost.city')->where('user_id', Auth::id())->get();

        return view('applied_jobs.index', compact('appliedJobs'));
    }

    public function adminindex()
    {
        // Load applied jobs that are not shortlisted
        $appliedJobs = AppliedJob::with(['jobPost', 'user'])
            ->where('shortlisted', false) // Exclude shortlisted jobs
            ->get();
    
        return view('job_posts.applyjob', compact('appliedJobs'));
    }
    

    public function shortlist($id)
    {
        $appliedJob = AppliedJob::findOrFail($id);
    
    // Update the shortlist status
    $appliedJob->update(['shortlisted' => true]);

    // Send email notification to the user
    Mail::to($appliedJob->user->email)->send(new ResumeShortlisted($appliedJob->user));
    
        // Redirect to the shortlist page with a success message
        return redirect()->route('shortlist.view')->with('status', 'User shortlisted successfully!');
    }
    

    public function showShortlist()
{
    $shortlistedJobs = AppliedJob::where('shortlisted', true)->with('user', 'jobPost.city')->get();

    return view('job_posts.shortlist', compact('shortlistedJobs'));
}


}

