<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Account Created Successfully - Itapp Digital')
            ->greeting('Welcome to Itapp Digital!')
            ->line('Your account has been created successfully.')
            ->line('Account Details:')
            ->line('**Name:** ' . $notifiable->name)
            ->line('**Email:** ' . $notifiable->email)
            ->line('**Username:** ' . $notifiable->username)
            ->line('**Status:** ' . ucfirst($notifiable->status))
            ->line('Your account is currently pending approval. You will be notified once your account is activated.')
            ->action('Go to Dashboard', url('/dashboard'))
            ->line('Thank you for choosing Itapp Digital!')
            ->salutation('Best Regards, The Itapp Digital Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

