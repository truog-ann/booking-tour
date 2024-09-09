<?php

namespace App\Listeners;

use App\Events\BookingCreate;
use App\Models\Booking;
use App\Notifications\NewBooking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBookingCreatedNotifications implements ShouldQueue
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
    public function handle(BookingCreate $event): void
    {
        //
        $event->booking->notify(new NewBooking($event->booking));
        
        
    }
}
