<?php

namespace App\Listeners;

use App\Events\BookingDone;
use App\Mail\BookingConfirmation;
use App\Models\Speaker;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBookingConfirmation implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BookingDone  $event
     * @return void
     */
    public function handle(BookingDone $event)
    {
        if ($event->booking->speaker && $event->booking->speaker->email) {
            Mail::to($event->booking->speaker->email, $event->booking->speaker->name)->send(new BookingConfirmation($event->booking));
        }
    }

    /**
     * Determine whether the listener should be queued.
     *
     * @param  \App\Events\OrderPlaced  $event
     * @return bool
     */
    public function shouldQueue(BookingDone $event)
    {
        return $event->booking->settings->notifications->confirmation;
    }
}
