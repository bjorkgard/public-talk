<?php

namespace App\Http\Controllers;

use App\Repositories\Php46Elks\Php46ElksClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

class StripeController extends Controller
{
    public function portal(Request $request)
    {
        return $request->user()->settings->redirectToBillingPortal(
            route('bookings.index')
        );
    }

    public function registerNumber(Request $request)
    {
        if (App::environment('production')) {
            $php46ElksClient = new Php46ElksClient(config('services.46elks.username'), config('services.46elks.password'));
            $response = $php46ElksClient->number()->allocate('se', ['sms', 'voice'], 'mobile', ['sms_url' => url('sms')]);

            $request->user()->settings->number()->create([
                'id' => $response->id(),
                'active' => $response->active(),
                'country' => $response->country(),
                'number' => $response->number()
            ]);
        } else {
            $request->user()->settings->number()->create([
                'id' => 'demo',
                'active' => 'yes',
                'country' => 'se',
                'number' => '+46700000000'
            ]);
        }

        $request->session()->flash('success', 'Din prenumeration är startad');

        return Redirect::route('settings.index');
    }
}
