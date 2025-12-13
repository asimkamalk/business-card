<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $contactMessage;

    /**
     * Create a new notification instance.
     */
    public function __construct(ContactMessage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
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
            ->subject('New Contact Form Submission - Itapp Digital')
            ->greeting('New Contact Message Received!')
            ->line('You have received a new contact form submission:')
            ->line('**Full Name:** ' . $this->contactMessage->full_name)
            ->line('**WhatsApp Number:** ' . $this->contactMessage->whatsapp_number)
            ->line('**Message:**')
            ->line($this->contactMessage->message)
            ->action('View in Admin Dashboard', url('/admin/contact-messages'))
            ->line('Thank you for using Itapp Digital!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'contact_message_id' => $this->contactMessage->id,
            'full_name' => $this->contactMessage->full_name,
        ];
    }
}
