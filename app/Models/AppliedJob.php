<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\JobPost;

class AppliedJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_post_id',
        'shortlisted',
    ];

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    // Add the user relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
