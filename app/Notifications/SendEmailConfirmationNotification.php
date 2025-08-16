<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Bookings\Models\Booking;

class SendEmailConfirmationNotification extends Notification
{
    //use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Booking $booking)
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
        $serviceName = $this->booking->service->name;

        $providerName = $this->booking->provider->name;

        $date = $this->booking
            ->scheduled_at
            ->setTimezone($this->booking->customer->timezone)
            ->isoFormat('llll');

        return (new MailMessage)
            ->subject('Booking Confirmation')
            ->line("Dear, {$notifiable->name}")
            ->line("You have booked  **$serviceName** at  **$date**  with Mr: **$providerName**")
            ->line('Thank you for using our application!');
    }
}
