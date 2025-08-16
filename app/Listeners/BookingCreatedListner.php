<?php

namespace App\Listeners;

use App\Notifications\CreatedBookingNotification;
use App\Notifications\SendEmailConfirmationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\InteractsWithQueue;

class BookingCreatedListner
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $customer = $event->booking->customer;
        $provider = $event->booking->provider;

        $customer->notify(new SendEmailConfirmationNotification($event->booking));
        $provider->notify(new CreatedBookingNotification($event->booking));
    }
}
