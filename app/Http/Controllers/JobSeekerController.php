<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountDeactivationMail;
use App\Mail\AccountActivationMail;

class JobSeekerController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all job seekers from the database
        $query = User::where('role', 'user');

        // Optional: Add filtering logic
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('job_location', 'LIKE', "%{$search}%");
            });
        }

        $jobSeekers = $query->get();

        return view('admin.dashboard', compact('jobSeekers'));
    }

    public function destroy($id)
    {
        $jobSeeker = User::findOrFail($id);
        $jobSeeker->delete(); // Soft delete the user

        // Remove photo and resume from disk
        if ($jobSeeker->photo) {
            Storage::delete('public/photos/' . $jobSeeker->photo);
        }
        if ($jobSeeker->resume) {
            Storage::delete('public/resumes/' . $jobSeeker->resume);
        }

        // Send deactivation email
        Mail::to($jobSeeker->email)->send(new AccountDeactivationMail($jobSeeker));

        return redirect()->back()->with('status', 'Job seeker deleted successfully!');
    }

    public function restore($id)
    {
        $jobSeeker = User::withTrashed()->findOrFail($id);
        $jobSeeker->restore(); // Restore the user

        // Send activation email
        Mail::to($jobSeeker->email)->send(new AccountActivationMail($jobSeeker));

        return redirect()->back()->with('status', 'Job seeker restored successfully!');
    }

    // Show deleted job seekers
    public function deleted()
    {
        $deletedJobSeekers = User::onlyTrashed()->where('role', 'user')->get();
        return view('admin.deleted', compact('deletedJobSeekers'));
    }

    public function forceDelete($id)
    {
        $jobSeeker = User::onlyTrashed()->findOrFail($id);
        $jobSeeker->forceDelete(); // Permanently delete

        // Optionally, remove photo and resume from disk
        if ($jobSeeker->photo) {
            Storage::delete('public/photos/' . $jobSeeker->photo);
        }
        if ($jobSeeker->resume) {
            Storage::delete('public/resumes/' . $jobSeeker->resume);
        }

        return redirect()->back()->with('status', 'Job seeker permanently deleted successfully!');
    }
}
