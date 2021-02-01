<?php

namespace App\Http\Controllers;

use App\Events\SpeakerDelete;
use App\Http\Requests\SpeakerStoreRequest;
use App\Http\Requests\SpeakerUpdateRequest;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SpeakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Inertia
     */
    public function index(Request $request)
    {

        $sort = $request->has('sort') ? $request->input('sort') : 'lastname';
        $order = $request->has('order') ? $request->input('order') : 'asc';
        $search = $request->has('search') ? $request->input('search') : '';

        //TODO: Only get the latest booking for all talks
        if ($request->has('search')) {
            $speakers = Speaker::with('lastBooking')
                ->where('firstname', 'like', '%' . $request->input('search') . '%')
                ->orWhere('lastname', 'like', '%' . $request->input('search') . '%')
                ->orWhere('congregation', 'like', '%' . $request->input('search') . '%')
                ->orWhere('phone', 'like', '%' . $request->input('search') . '%')
                ->orWhere('email', 'like', '%' . $request->input('search') . '%')
                ->orderBy($sort, $order)
                ->paginate();
        } else {
            $speakers = Speaker::with('lastBooking')->orderBy($sort, $order)->paginate();
        }
        $speakers->appends(['sort' => $sort, 'order' => $order, 'search' => $search]);

        return Inertia::render('Speakers/Index', ['speakers' => $speakers, 'search' => $search]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Controllers\SpeakerStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpeakerStoreRequest $request)
    {
        $speaker = Speaker::create($request->validated());
        $speaker->talks()->sync($request->input('talks'));

        $request->session()->flash('success', $speaker->firstname . ' ' . $speaker->lastname . ' är tillagd');

        return Redirect::route('speakers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function show(Speaker $speaker)
    {
        $speaker = Speaker::where('id', $speaker->id)->with(['talks' => function ($query) use ($speaker) {
            $query->withTrashed()->with(['bookings' => function ($q) use ($speaker) {
                $q->where('speaker_id', $speaker->id)->orderBy('date', 'desc')->limit(1);
            }]);
        }])->first();

        return $speaker;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SpeakerUpdateRequest  $request
     * @param  \App\Models\Speaker  $speaker
     * @return \Illuminate\Http\Response
     */
    public function update(SpeakerUpdateRequest $request, Speaker $speaker)
    {
        $speaker->update($request->validated());
        $speaker->talks()->sync($request->input('talks'));


        $request->session()->flash('success', $speaker->firstname . ' ' . $speaker->lastname . ' är uppdaterad');

        return Redirect::route('speakers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\Speaker  $speaker
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Speaker $speaker)
    {
        event(new SpeakerDelete($speaker));

        $speaker->delete();

        $request->session()->flash('success', 'Talaren är raderad');

        return redirect()->route('speakers.index');
    }
}
