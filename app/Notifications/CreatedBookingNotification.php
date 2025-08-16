<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Modules\Bookings\Models\Booking;


class CreatedBookingNotification extends Notification
{
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
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'new booking',
            'booking_id'    => $this->booking->id,
            'service_id'    => $this->booking->service_id,
            'customer_id'   => $this->booking->customer_id,
            'scheduled_at'  => $this->booking->scheduled_at
        ];
    }
}
