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
    public function index()
    {
        $subscriptionPlans = $this->getSubcriptionPlans();

        return Inertia::render('Settings/Index', ['subscriptionPlans' => $subscriptionPlans]);
    }

    private function getSubcriptionPlans() {
        $subscriptionPlans[] = Auth::user()->settings->newSubscription('sms', 'price_1IRnMvG2876YRaIghhsfmd33')
            ->trialDays(7)
            ->checkout([
                'success_url' => route('bookings.index'),
                'cancel_url' => route('bookings.index'),
            ]);

        $subscriptionPlans[] = Auth::user()->settings->newSubscription('sms', 'price_1IRnMvG2876YRaIgfvY4P1EQ')
            ->trialDays(7)
            ->checkout([
                'success_url' => route('bookings.index'),
                'cancel_url' => route('bookings.index'),
            ]);

        return $subscriptionPlans;
    }
}
