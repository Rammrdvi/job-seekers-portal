<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    // Show the profile edit form
    public function edit()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('auth.profile.edit', compact('user')); // Pass user data to the view
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'experience' => ['required', 'integer', 'min:0'],
            'notice_period' => ['required', 'integer', 'min:0'],
            'skills' => ['required', 'string'],
            'job_location' => ['required', 'string'],
            'resume' => ['nullable', 'file', 'mimes:pdf', 'max:20480'], // 2MB max
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:20480'], // 2MB max
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update user information
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->experience = $request->input('experience');
        $user->notice_period = $request->input('notice_period');
        $user->skills = $request->input('skills');
        $user->job_location = $request->input('job_location');

        // Handle file uploads
        if ($request->hasFile('resume')) {
            $user->resume = $this->uploadFile($request->file('resume'), 'resumes');
        }

        if ($request->hasFile('photo')) {
            $user->photo = $this->uploadFile($request->file('photo'), 'photos');
        }

        // Save updated user information
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    // Helper function to handle file uploads
    protected function uploadFile($file, $folder)
    {
        if ($file) {
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/' . $folder), $fileName);
            return $fileName;
        }
        return null;
    }
}

