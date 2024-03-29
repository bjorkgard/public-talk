<?php

namespace App\Console\Commands;

use App\Mail\BookingChairman;
use App\Models\Booking;
use App\Models\MessageLog;
use App\Repositories\Php46Elks\Php46ElksClient;
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
    protected $description = 'Send a message to the chairman 7 days before.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $nextWeek = Carbon::now()->addDays(7)->format('Y-m-d');
        $bookings = Booking::where('date', $nextWeek)->where('no_meeting', false)->with('settings', 'chairman')->get();

        foreach ($bookings as $booking) {
            if ($booking->chairman) {
                if ($booking->chairman->email && $booking->settings->notifications->chairman_mail) {
                    Mail::to($booking->chairman->email, $booking->chairman->name)->queue(new BookingChairman($booking));
                }

                if ($booking->settings->subscribed('default') && $booking->chairman->phone && $booking->settings->notifications->chairman_sms) {
                    $php46ElksClient = new Php46ElksClient(config('services.46elks.username'), config('services.46elks.password'));
                    $sms = $php46ElksClient->sms()->SMSDispatcher();

                    $talk = !is_null($booking->talk) ? $booking->talk->theme : $booking->custom_talk;
                    $speaker = !is_null($booking->speaker) ? $booking->speaker->firstname . ' ' . $booking->speaker->lastname : $booking->custom_speaker;
                    $phone = !is_null($booking->speaker) ? $booking->speaker->formated_phone : '';
                    $congregation = !is_null($booking->speaker) ? $booking->speaker->congregation : '';

                    $response = $sms
                        ->from($booking->user->settings->number->number)
                        ->recipient($booking->chairman->phone)
                        ->line('Du har blivit utsedd till ordförande för följande föreläsning.')
                        ->line()
                        ->line('Datum: ' . $booking->date)
                        ->line('Tid: ' . substr($booking->time, 0, strrpos($booking->time, ':')))
                        ->line('Tema: ' . $talk)
                        ->line('Talare: ' . $speaker)
                        ->line('Telefon: ' . $phone)
                        ->line('Församling: ' . $congregation)
                        ->line()
                        ->line(isset($booking->user->settings->chairman->message) ? $booking->user->settings->chairman->message : '')
                        ->line()
                        ->line($booking->reminder ? (isset($booking->settings->chairman->reminder) ? $booking->settings->chairman->reminder : 'Talaren har fått en automatisk påminnelse') : (isset($booking->settings->chairman->noReminder) ? $booking->settings->chairman->noReminder : 'Talaren har inte fått en automatisk påminnelse'))
                        ->send();

                    MessageLog::create([
                        'user_id' => $booking->user->id,
                        'from' => $response[0]['from'],
                        'to' => $response[0]['to'],
                        'message' => $response[0]['message']
                    ]);

                    // Report to Stripe number of SMS parts
                    $booking->settings->subscription('default')->reportUsageFor(config('services.stripe.sms'), $response[0]['parts']);
                }
            }
        }
    }
}
