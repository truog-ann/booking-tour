<?php

namespace App\Listeners;

use App\Events\BookingStatusUpdated;
use App\Notifications\BookingStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotifyBookingUpdated implements ShouldQueue
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
    public function handle(BookingStatusUpdated $event): void
    {
        //
        $event->booking->notify(new BookingStatus($event->booking));

    }
}
