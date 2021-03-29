<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        \App\Events\BookingDone::class => [
            \App\Listeners\SendBookingConfirmation::class
        ],

        \App\Events\TalkDelete::class => [
            \App\Listeners\SendBookingWarning::class
        ],

        \App\Events\SpeakerDelete::class => [
            \App\Listeners\SendSpeakerDeleteWarning::class
        ],

        'Laravel\Cashier\Events\WebhookHandled' => [
            \App\Listeners\StripePostHandler::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
