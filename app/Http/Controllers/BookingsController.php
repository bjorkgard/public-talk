<?php

namespace App\Http\Controllers;

use App\Events\BookingDone;
use App\Http\Requests\BookingCommentRequest;
use App\Http\Requests\BookingDestroyRequest;
use App\Http\Requests\BookingGreetingRequest;
use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\BookingUpdateRequest;
use App\Mail\BookingDeleted;
use App\Mail\SendThankYou;
use App\Models\Booking;
use App\Models\Chairman;
use App\Models\Settings;
use App\Models\Speaker;
use App\Models\Talk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BookingsController extends Controller
{
    public function index(Request $request)
    {
        $settings = Settings::where('user_id', $request->user()->id)->first();
        $bookings = [];

        if ($request->has('startDate')) {
            $startDate = Carbon::create($request->input('startDate'))->locale('sv');
        } else {
            $startDate = Carbon::now()->locale('sv')->subWeek();
        }

        $nextWeek = $startDate->copy()->addWeek(1);
        $nextMonth = $startDate->copy()->addMonth(1);

        $weekStart = $startDate->copy()->startOfWeek();
        $weekEnd = $startDate->copy()->endOfWeek();

        for ($i = 0; $i < 10; $i++) {
            $existingBookings = Booking::with(['talk' => function ($q) {
                $q->withTrashed();
            }])->whereBetween('date', [$weekStart, $weekEnd])->get();

            if (count($existingBookings) > 0) {
                foreach ($existingBookings as $b) {
                    $b->upcoming = Carbon::create($b->date)->isFuture();
                    $bookings[] = $b;
                }
            } else {
                // If no booking exist we create an empty with only date
                $bookings[] = collect(new Booking([
                    'date' => $weekStart->copy()->next($settings->meeting->day)->format('Y-m-d')
                ]));
            }

            $weekStart->addWeek();
            $weekEnd->addWeek();
        }

        return Inertia::render('Bookings/Index', [
            'previousWeek' => $startDate->copy()->subWeek()->format('Y-m-d'),
            'previousMonth' => $startDate->copy()->subMonth()->format('Y-m-d'),
            'nextWeek' => $nextWeek->format('Y-m-d'),
            'nextMonth' => $nextMonth->format('Y-m-d'),
            'bookings' => $bookings
        ]);
    }

    public function create(Request $request)
    {
        $settings = Settings::where('user_id', $request->user()->id)->first();

        // date
        $date = null;
        if ($request->has('date')) {
            $date = $request->input('date');
        }

        return Inertia::render('Bookings/Form', [
            'booking' => [
                'date' => $date,
                'time' => $settings->meeting->time,
                'talk_id' => $request->input('talk_id'),
                'speaker_id' => $request->input('speaker_id'),
            ],
            'speakers' => Speaker::all(),
            'talks' => Talk::with('speakers')->get(),
            'chairmen' => Chairman::all()
        ]);
    }

    public function store(BookingStoreRequest $request)
    {
        $booking = Booking::create($request->validated());
        $booking->update([
            'identifier' => Str::orderedUuid()
        ]);

        event(new BookingDone($booking->load('user', 'speaker', 'talk')));

        return redirect()->route('bookings.index', ['startDate' => $request->input('date')]);
    }

    /**
     * Remove the booking
     * 
     * @param \App\Http\Requests\BookingDestroyRequest $request
     * @param \App\Models\Booking $booking
     */
    public function destroy(BookingDestroyRequest $request, Booking $booking)
    {
        if ($request->input('message')) {
            Mail::to($booking->speaker->email)->send(new BookingDeleted($request->user(), $booking->date));
            $request->session()->flash('success', 'Bokningen är raderad och talaren har fått en bekräftelse');
        } else {
            $request->session()->flash('success', 'Bokningen är raderad');
        }

        $booking->delete();

        return redirect()->route('bookings.index', ['startDate' => $booking->date]);
    }

    public function edit(Request $request, Booking $booking)
    {
        if ($request->user()->id != $booking->user_id) {
            abort(403);
        }

        return Inertia::render('Bookings/Form', [
            'booking' => [
                'id' => $booking->id,
                'date' => $booking->date,
                'time' => date('H:i', strtotime($booking->time)),
                'song' => $booking->song,
                'talk_id' => $booking->talk_id,
                'speaker_id' => $booking->speaker_id,
                'chairman_id' => $booking->chairman_id,
                'exception' => $booking->exception,
                'custom_talk' => $booking->custom_talk,
                'custom_speaker' => $booking->custom_speaker,
            ],
            'speakers' => Speaker::all(),
            'talks' => Talk::with('speakers')->get(),
            'chairmen' => Chairman::all()
        ]);
    }

    public function update(BookingUpdateRequest $request, Booking $booking)
    {
        $booking->update($request->validated());

        $request->session()->flash('success', 'Bokningen för ' . $booking->date . ' är uppdaterad');

        return redirect()->route('bookings.index');
    }

    public function showComments(Booking $booking)
    {
        return Inertia::render('Bookings/Comments', ['booking' => $booking]);
    }

    public function comments(BookingCommentRequest $request, Booking $booking)
    {
        $booking->update($request->validated());

        $request->session()->flash('success', 'Kommentaren är sparad!');

        return redirect()->route('bookings.index');
    }

    public function showThanks(Booking $booking)
    {
        return Inertia::render('Bookings/ThankYou', ['booking' => $booking]);
    }

    public function greeting(BookingGreetingRequest $request, Booking $booking)
    {
        $booking->update([
            'thanked' => true,
            'identifier' => null
        ]);

        Mail::to($booking->speaker->email, $booking->speaker->full_name)->queue(new SendThankYou($booking, $request->input('greeting')));

        $request->session()->flash('success', 'En hälsning till ' . $booking->speaker->full_name . ' är skickad');

        return redirect()->route('bookings.index');
    }
}
