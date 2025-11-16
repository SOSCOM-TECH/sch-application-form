<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SchoolApproved extends Notification
{
    use Queueable;

    public function __construct(public string $schoolName)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your school has been approved')
            ->greeting('Congratulations!')
            ->line("Your school '{$this->schoolName}' has been approved.")
            ->action('Go to Dashboard', url('/client'))
            ->line('You can now create and publish forms and start accepting applications.');
    }
}


