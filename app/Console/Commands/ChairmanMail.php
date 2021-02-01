<?php

namespace App\Console\Commands;

use App\Mail\BookingChairman;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ChairmanMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pt:chairman';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to the chairman 7 days before.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $nextWeek = Carbon::now()->addDays(7)->format('Y-m-d');
        $bookings = Booking::where('date', $nextWeek)->with('user', 'chairman')->get();

        foreach ($bookings as $booking) {
            if ($booking->speaker->email && $booking->user->settings->notifications->chairman) {
                Mail::to($booking->chairman->email, $booking->chairman->name)->queue(new BookingChairman($booking));
            }
        }
    }
}
