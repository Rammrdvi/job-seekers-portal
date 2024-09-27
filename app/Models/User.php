<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AppliedJob;
use App\Models\City;

class User extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone', 
        'experience', 
        'notice_period', 
        'skills', 
        'job_location', 
        'resume', 
        'photo',
        'role', // Add role to fillable attributes
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Check if the user is an admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Check if the user is a job seeker
    public function isJobSeeker()
    {
        return $this->role === 'user';
    }


    public function appliedJobs()
    {
        return $this->hasMany(AppliedJob::class);
    }

    public function city(): BelongsTo
{
    return $this->belongsTo(City::class, 'job_location');
}
}
