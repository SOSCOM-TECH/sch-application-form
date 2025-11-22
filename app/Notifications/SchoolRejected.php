<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SchoolRejected extends Notification
{
    use Queueable;

    public function __construct(public string $reason)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('School verification update')
            ->greeting('Hello,')
            ->line('Your school verification request was rejected.')
            ->line('Reason: '.$this->reason)
            ->line('Please contact an administrator for assistance.');
    }
}


