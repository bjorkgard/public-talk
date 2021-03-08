<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $checkout = $request->user()->settings->newSubscription('default', 'price_1IRnMvG2876YRaIghhsfmd33')
            ->trialDays(7)
            ->checkout([
                'success_url' => route('settings.index'),
                'cancel_url' => route('settings.index'),
            ]);

        return Inertia::render('Settings/Index', [
            'stripeKey' => config('services.stripe.key'),
            'sessionId' => $checkout->id
        ]);
    }
}
