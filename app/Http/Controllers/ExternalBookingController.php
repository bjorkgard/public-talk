<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExternalBookingController extends Controller
{
    public function index($identifier)
    {
        $booking = Booking::where('identifier', $identifier)->firstOrFail();

        return Inertia::render('Bookings/ExternalThankYou', ['booking' => $booking]);
    }
}
