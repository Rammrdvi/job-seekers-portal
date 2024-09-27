<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    // Show the change password form
    public function showChangePasswordForm()
    {
        return view('auth.passwords.change');
    }

    // Handle the password change request
    public function changePassword(Request $request)
    {
        // Validate the input data
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if the old password matches the user's current password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->withErrors(['old_password' => 'The current password is incorrect.']);
        }

        // Update the user's password
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password successfully changed!');
    }
}
