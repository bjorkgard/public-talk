<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function portal(Request $request)
    {
        return $request->user()->settings->redirectToBillingPortal(
            route('bookings.index')
        );
    }

    public function subscribe(Request $request) {
        $request->user()->settings->newSubscription('sms', 'monthly')
            ->trialDays(10)
            ->create($request->paymentMethodId);
    }
}
