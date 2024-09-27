<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\AppliedJobController;

use Illuminate\Support\Facades\Auth;


// Landing page
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Auth::routes(); // Includes login, logout, registration, etc.
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.post');


Route::get('/test-mail', function () {
    $user = App\Models\User::first(); // Retrieve a user for testing
    Mail::to($user->email)->send(new App\Mail\UserUpdatedMail($user));
    return 'Mail sent!';
});


// Apply role-based redirection for home page and user-specific routes
Route::middleware(['user'])->group(function () {

    // Regular user routes
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Profile routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');    
    // Change password routes
    Route::get('/password/change', [PasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/password/change', [PasswordController::class, 'changePassword'])->name('password.update');

    Route::post('/job-posts/{jobPost}/apply', [JobPostController::class, 'apply'])->name('job_posts.apply');

    Route::get('/applied-jobs', [AppliedJobController::class, 'index'])->name('applied_jobs.index');

});

// Admin routes
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/home', [AdminDashboardController::class, 'index'])->name('admin.home');
    Route::get('job_seekers/deleted', [AdminDashboardController::class, 'deleted'])->name('job_seekers.deleted');

    Route::delete('job_seekers/{id}/force-delete', [AdminDashboardController::class, 'forceDelete'])->name('job_seekers.forceDelete');

    Route::get('/admin/job-posts', [JobPostController::class, 'index'])->name('job_posts.index');
    Route::get('/admin/job-posts/create', [JobPostController::class, 'create'])->name('job_posts.create');
    Route::post('/admin/job-posts', [JobPostController::class, 'store'])->name('job_posts.store');
    Route::post('/admin/job-posts/{jobPost}/apply', [JobPostController::class, 'apply'])->name('job_posts.apply');

    Route::get('/admin/job-posts/{jobPost}/edit', [JobPostController::class, 'edit'])->name('job_posts.edit');
    Route::put('/admin/job-posts/{jobPost}', [JobPostController::class, 'update'])->name('job_posts.update');
    
    Route::delete('/admin/job-posts/{jobPost}', [JobPostController::class, 'destroy'])->name('job_posts.destroy');
    
    // Trashed job posts
    Route::get('/admin/job-posts/trashed', [JobPostController::class, 'trashed'])->name('job_posts.trashed');
    Route::post('/admin/job-posts/{id}/restore', [JobPostController::class, 'restore'])->name('job_posts.restore');

    // Delete job seeker photo
    Route::get('/admin/job-seekers', [JobSeekerController::class, 'index'])->name('job_seekers.index');
    Route::delete('/admin/job-seekers/{id}/photo', [JobSeekerController::class, 'destroy'])->name('job_seekers.photo.delete');
    Route::post('/admin/job-seekers/{id}/restore', [JobSeekerController::class, 'restore'])->name('job_seekers.restore');


    Route::get('/admin/applied-jobs', [AppliedJobController::class, 'adminindex'])->name('admin.applied_jobs.index');

    Route::post('/shortlist/{appliedJob}', [AppliedJobController::class, 'shortlist'])->name('shortlist');
    Route::get('/shortlist', [AppliedJobController::class, 'showShortlist'])->name('shortlist.view');


});






