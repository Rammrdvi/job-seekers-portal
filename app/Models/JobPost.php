<?php
// app/Models/JobPost.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPost extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['title', 'description', 'salary', 'city_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'applied_jobs');
    }

    public function jobPost()
{
    return $this->belongsTo(JobPost::class);
}

}
