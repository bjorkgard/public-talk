<?php

namespace App\Listeners;

use App\Events\SpeakerDelete;
use App\Mail\SpeakerDeleted;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendSpeakerDeleteWarning
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
     * @param  SpeakerDelete  $event
     * @return void
     */
    public function handle(SpeakerDelete $event)
    {
        $maildata = $event->speaker->load('bookings.user');
        $today = Carbon::now()->format('Y-m-d');

        foreach ($maildata->bookings as $booking) {
            if ($booking->date > $today) {
                $booking->update(['speaker_id' => null, 'talk_id' => null]);
                Mail::to($booking->user->email, $booking->user->name)->send(new SpeakerDeleted($booking));
            }
        }
    }
}
