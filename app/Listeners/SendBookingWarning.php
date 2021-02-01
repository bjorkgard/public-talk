<?php

namespace App\Listeners;

use App\Events\TalkDelete;
use App\Mail\TalkDeleted;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBookingWarning implements ShouldQueue
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
     * @param  TalkDelete  $event
     * @return void
     */
    public function handle(TalkDelete $event)
    {
        $maildata = $event->talk->load('bookings.user');
        $today = Carbon::now()->format('Y-m-d');

        foreach ($maildata->bookings as $booking) {
            if ($booking->date > $today) {
                Mail::to($booking->user->email, $booking->user->name)->send(new TalkDeleted($booking));
            }
        }
    }
}
