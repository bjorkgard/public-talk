<?php

namespace App\Console\Commands;

use App\Mail\BookingReminder;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ReminderSpeaker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pt:remind-speaker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a reminder to speaker 7 days before their booked talk.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $nextWeek = Carbon::now()->addDays(7)->format('Y-m-d');
        $bookings = Booking::where('date', $nextWeek)->with('user')->get();

        foreach ($bookings as $booking) {
            if ($booking->speaker->email && $booking->user->settings->notifications->reminder) {
                Mail::to($booking->speaker->email, $booking->speaker->name)->queue(new BookingReminder($booking));
            }
        }
    }
}
