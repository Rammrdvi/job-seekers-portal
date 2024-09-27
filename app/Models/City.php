<?php

// app/Models/City.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobPost;

class City extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];
    
    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }
}
