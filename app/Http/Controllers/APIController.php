<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    public function bookings(Request $request, $weeks) {
        $bookings = [];

        // set dates
        $startDate = Carbon::now()->locale('sv');
        $start = $startDate->copy()->startOfWeek();
        $end = $startDate->copy()->endOfWeek()->addWeeks($weeks - 1);
        
        $bookings = DB::table('bookings')
                ->where('bookings.settings_id', $request->user()->settings->id)
                ->whereBetween('bookings.date', [$start, $end])
                ->leftJoin('chairmen', 'chairmen.id', '=', 'bookings.chairman_id')
                ->leftJoin('talks', 'talks.id', '=', 'bookings.talk_id')
                ->leftJoin('speakers', 'speakers.id', '=', 'bookings.speaker_id')
                ->select('date', 'time', 'song', 'custom_talk', 'custom_speaker', 'no_meeting', 'bookings.comments as comments', 'chairmen.name as chairman', 'talks.theme as theme', 'speakers.firstname', 'speakers.lastname', 'speakers.congregation')
                ->orderBy('bookings.date')
                ->get();

        return $bookings;
    }
}
