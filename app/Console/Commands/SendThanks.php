<?php

namespace App\Console\Commands;

use App\Mail\SendThanksReminder;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendThanks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pt:send-thanks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind user to send a thank you to the speaker.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $yesterday = Carbon::now()->subDays(1)->format('Y-m-d');
        $bookings = Booking::where('date', $yesterday)->where('thanked', false)->where('no_meeting', false)->whereNotNull('identifier')->with('user', 'settings')->get();

        foreach ($bookings as $booking) {
            if (($booking->speaker->email && $booking->settings->notifications->thanks_mail) || ($booking->speaker->phone && $booking->settings->notifications->thanks_sms)) {
                Mail::to($booking->user->email, $booking->user->name)->queue(new SendThanksReminder($booking));
            }
        }
    }
}
