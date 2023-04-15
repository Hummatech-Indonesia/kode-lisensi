<?php

namespace App\Notifications;

use App\Mail\RegistrationMail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class RegistrationNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return mixed
     */

    public function toMail(mixed $notifiable): mixed
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return Mail::to($notifiable)->queue(new RegistrationMail($notifiable, $verificationUrl));
    }
}
