<?php

namespace App\Listeners;

use App\Events\BookingDone;
use App\Mail\BookingConfirmation;
use App\Repositories\Php46Elks\Php46ElksClient;
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
        if ($event->booking->speaker) {
            // send confirmation by email
            if ($event->booking->speaker->email && $event->booking->settings->notifications->confirmation_mail) {
                Mail::to($event->booking->speaker->email, $event->booking->speaker->name)->send(new BookingConfirmation($event->booking));

                $event->booking->update(['confirmation' => true]);
            }

            // send confirmation by SMS
            if ($event->booking->settings->subscribed('default') && $event->booking->speaker->phone && $event->booking->settings->notifications->confirmation_sms) {
                $php46ElksClient = new Php46ElksClient(config('services.46elks.username'), config('services.46elks.password'));
                $sms = $php46ElksClient->sms()->SMSDispatcher();

                $response = $sms
                    ->from($event->booking->user->settings->number->number)
                    ->recipient($event->booking->speaker->phone)
                    ->line('Tack för att du vill hålla en föreläsning hos oss.')
                    ->line()
                    ->line('Församling: ' . $event->booking->settings->congregation->name)
                    ->line('Kontakt: ' . $event->booking->user->name . ', ' . $event->booking->user->formated_phone)
                    ->line('Datum: ' . $event->booking->date)
                    ->line('Tid: ' . substr($event->booking->time, 0, strrpos($event->booking->time, ':')))
                    ->line('Tema: (' . $event->booking->talk->number . ') ' . $event->booking->talk->theme)
                    ->send();

                // Report to Stripe number of SMS parts
                $event->booking->settings->subscription('default')->reportUsageFor(config('services.stripe.sms'), $response[0]['parts']);

                $event->booking->update(['confirmation' => true]);
            }
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
        return $event->booking->settings->notifications->confirmation_mail || $event->booking->settings->notifications->confirmation_sms;
    }
}
