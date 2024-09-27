<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegisteredMail;
use App\Mail\UserUpdatedMail;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    public function created(User $user)
    {
        // Send email to admin when a new user registers
        Mail::to('admin@texila.com')->send(new UserRegisteredMail($user));
    }

    public function updated(User $user)
    {
        // Send email to admin when a user updates their profile
        Mail::to('admin@texila.com')->send(new UserUpdatedMail($user));
    }
}
