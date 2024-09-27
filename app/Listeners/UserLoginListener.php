<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserLoginMail;

class UserLoginListener
{
    public function handle(Login $event)
    {
        Mail::to('admin@texila.com')->send(new UserLoginMail($event->user));
    }
}
