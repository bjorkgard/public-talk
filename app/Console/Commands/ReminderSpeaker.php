<?php

namespace App\Console\Commands;

use App\Mail\BookingReminder;
use App\Models\Booking;
use App\Repositories\Php46Elks\Php46ElksClient;
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
        $bookings = Booking::where('date', $nextWeek)->with('settings')->get();

        foreach ($bookings as $booking) {
            if ($booking->speaker) {
                if ($booking->speaker->email && $booking->settings->notifications->reminder_mail) {
                    Mail::to($booking->speaker->email, $booking->speaker->name)->queue(new BookingReminder($booking));

                    $booking->update(['reminder' => true]);
                }

                // send confirmation by SMS
                if ($booking->settings->subscribed('default') && $booking->speaker->phone && $booking->settings->notifications->reminder_sms) {
                    $php46ElksClient = new Php46ElksClient(config('services.46elks.username'), config('services.46elks.password'));
                    $sms = $php46ElksClient->sms()->SMSDispatcher();

                    $response = $sms
                        ->from($booking->user->settings->number->number)
                        ->recipient($booking->speaker->phone)
                        ->line('Det här är en påminnelse om din föreläsning nästa vecka.')
                        ->line()
                        ->line('Församling: ' . $booking->settings->congregation->name)
                        ->line('Kontakt: ' . $booking->user->name . ', ' . $booking->user->formated_phone)
                        ->line('Datum: ' . $booking->date)
                        ->line('Tid: ' . $booking->time)
                        ->line('Tema: (' . $booking->talk->number . ') ' . $booking->talk->theme)
                        ->dryRun(config('services.46elks.dryrun'))
                        ->send();

                    // Report to Stripe number of SMS parts
                    $booking->settings->subscription('default')->reportUsageFor(config('services.stripe.sms'), $response[0]['parts']);

                    $booking->update(['reminder' => true]);
                }
            }
        }
    }
}
