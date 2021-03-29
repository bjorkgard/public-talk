<?php

namespace App\Listeners;

use App\Models\Settings;
use App\Repositories\Php46Elks\Php46ElksClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookHandled;

use function GuzzleHttp\json_encode;

class StripePostHandler implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle(WebhookHandled $event)
    {
        ray()->newScreen();
        $type = $event->payload['type'];
        $payload = $event->payload;

        switch ($type) {
            case 'customer.subscription.deleted':
                $settings = Settings::where('stripe_id', $payload['data']['object']['customer'])->first();

                if ($settings->number->id != 'demo') {
                    $php46ElksClient = new Php46ElksClient(config('services.46elks.username'), config('services.46elks.password'));
                    $response = $php46ElksClient->number()->deallocate($settings->number->id, 'no');
                }

                $settings->number()->delete();

                break;
        }
    }
}
