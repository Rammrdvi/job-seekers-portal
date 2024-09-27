<?php
namespace App\Jobs;

use App\Mail\UserLoginMail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLoginNotificationJob extends Job implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle(Mailer $mailer)
    {
        $mailer->to($this->user->email)->send(new UserLoginMail($this->user));
    }
}
