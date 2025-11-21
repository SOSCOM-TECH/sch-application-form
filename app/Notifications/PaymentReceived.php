<?php

namespace App\Notifications;

use App\Models\Form;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentReceived extends Notification
{
    use Queueable;

    public function __construct(public Payment $payment, public Form $form)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Application Payment Received')
            ->greeting('Hello,')
            ->line("A new payment has been received for form '{$this->form->title}'.")
            ->line('Amount: '.number_format($this->payment->amount).' TZS')
            ->line('System amount (SOSCOM): '.number_format($this->payment->system_amount).' TZS')
            ->line('School amount: '.number_format($this->payment->school_amount).' TZS')
            ->action('View Applicants', url('/client/applicants'));
    }
}


