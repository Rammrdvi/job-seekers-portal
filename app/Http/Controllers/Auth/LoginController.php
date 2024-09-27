<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use App\Mail\UserLoginMail;
use App\Mail\UserLogoutMail;
use App\Mail\UserRegistrationMail;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if ($user->trashed()) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account is currently deactivated. Please contact support.',
                ]);
            }

            // Trigger the login event
            Event::dispatch(new Login($user, $user, $remember));

            // Send notifications
            $this->sendUserLoginNotification($user);
            $this->sendAdminLoginNotification($user);

            return redirect()->intended($user->isAdmin() ? '/admin/home' : '/home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        if ($user) {
            // Send logout notifications
            $this->sendUserLogoutNotification($user);
            
        }
    
        return redirect()->route('login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        // Send registration notifications
        $this->sendUserRegistrationNotification($user);
        $this->sendAdminRegistrationNotification($user);

        return redirect()->intended('/home');
    }

    protected function sendUserLoginNotification($user)
    {
        Mail::to($user->email)->send(new UserLoginMail($user));
    }

    protected function sendAdminLoginNotification($user)
    {
        $admins = User::where('role', 'admin')->get(); // Fetch all admins based on role

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new UserLoginMail($user));
        }
    }

    protected function sendUserLogoutNotification($user)
    {
        Mail::to($user->email)->send(new UserLogoutMail($user));
    }

    protected function sendAdminLogoutNotification($user)
    {
        $admins = User::where('role', 'admin')->get(); // Fetch all admins based on role

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new UserLogoutMail($user));
        }
    }

    protected function sendUserRegistrationNotification($user)
    {
        Mail::to($user->email)->send(new UserRegistrationMail($user));
    }

    protected function sendAdminRegistrationNotification($user)
    {
        $admins = User::where('role', 'admin')->get(); // Fetch all admins based on role

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new UserRegistrationMail($user));
        }
    }
}
