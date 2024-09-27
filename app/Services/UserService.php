<?php

namespace App\Services;

use App\Mail\UserLoginMail;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function sendLoginNotification($user)
    {
        Mail::to($user->email)->send(new UserLoginMail($user));
    }
}
