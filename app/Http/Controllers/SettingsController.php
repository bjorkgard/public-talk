<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $checkout = $request->user()->settings->newSubscription('default', [config('services.stripe.phone')])
            ->meteredPlan(config('services.stripe.sms'))
            ->checkout([
                'success_url' => route('stripe.success'),
                'cancel_url' => route('settings.index'),
            ]);

        return Inertia::render('Settings/Index', [
            'stripeKey' => config('services.stripe.key'),
            'sessionId' => $checkout->id
        ]);
    }
}
