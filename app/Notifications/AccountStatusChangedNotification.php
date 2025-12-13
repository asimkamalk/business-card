<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountStatusChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $status;
    protected $reason;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $status, string $reason = null)
    {
        $this->status = $status;
        $this->reason = $reason;
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
        $message = (new MailMessage)
            ->subject('Account Status Updated - Itapp Digital')
            ->greeting('Hello ' . $notifiable->name . '!');

        switch ($this->status) {
            case 'active':
                $message->line('Great news! Your account has been activated.')
                    ->line('You can now access all features of your Itapp Digital account.')
                    ->action('Go to Dashboard', url('/dashboard'));
                break;

            case 'suspended':
                $message->line('Your account has been suspended.')
                    ->line('If you believe this is an error, please contact our support team.')
                    ->line('**Reason:** ' . ($this->reason ?? 'Account suspended by administrator'));
                break;

            case 'deleted':
                $message->line('Your account has been deleted.')
                    ->line('If you believe this is an error, please contact our support team immediately.')
                    ->line('**Reason:** ' . ($this->reason ?? 'Account deleted by administrator'));
                break;

            case 'pending':
                $message->line('Your account status has been changed to pending.')
                    ->line('Your account is awaiting approval. You will be notified once it is activated.');
                break;

            default:
                $message->line('Your account status has been updated to: **' . ucfirst($this->status) . '**');
        }

        return $message
            ->line('If you have any questions, please contact us at info@itappdigital.com')
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
            'status' => $this->status,
            'reason' => $this->reason,
        ];
    }
}

