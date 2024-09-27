<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\City;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home'; // Redirect after registration

    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {
        $cities = City::all(); // Fetch all cities
        return view('auth.register', compact('cities'));
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:15'],
            'experience' => ['required', 'integer', 'min:0'],
            'notice_period' => ['required', 'integer', 'min:0'],
            'skills' => ['required', 'string'],
           'job_location' => ['required', 'exists:cities,id'], // Validate city exists
            'resume' => ['required', 'file', 'mimes:pdf', 'max:2048'], // 2MB max
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // 2MB max
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'experience' => $data['experience'],
            'notice_period' => $data['notice_period'],
            'skills' => $data['skills'],
            'job_location' => $data['job_location'],
            'resume' => $this->uploadFile($data['resume'], 'resumes'),
            'photo' => $this->uploadFile($data['photo'], 'photos'),
        ]);
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
