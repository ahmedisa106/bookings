<?php

namespace Modules\Bookings\Observers;

use App\Events\BookingCreated;
use Illuminate\Support\Facades\Event;
use Modules\Bookings\Models\Booking;

class BookingObserver
{
    /**
     * Handle the BookingObserver "created" event.
     */
    public function created(Booking $booking): void
    {
        Event::dispatch(new BookingCreated($booking));
    }

    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $bookingobserver): void {}

    /**
     * Handle the Booking "deleted" event.
     */
    public function deleted(Booking $bookingobserver): void {}

    /**
     * Handle the Booking "restored" event.
     */
    public function restored(Booking $bookingobserver): void {}

    /**
     * Handle the Booking "force deleted" event.
     */
    public function forceDeleted(Booking $bookingobserver): void {}
}
