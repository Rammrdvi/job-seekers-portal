<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserLoginMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

   // UserLoginMail.php
public function build()
{
    return $this->view('emails.user_login')  // Ensure this path is correct
                ->with(['user' => $this->user]);
}

}
