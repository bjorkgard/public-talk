<?php

namespace App\Http\Controllers;

use App\Events\TalkDelete;
use App\Http\Requests\TalkDestroyRequest;
use App\Http\Requests\TalkStoreRequest;
use App\Models\Talk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TalkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = $request->has('sort') ? $request->input('sort') : 'number';
        $order = $request->has('order') ? $request->input('order') : 'asc';
        $search = $request->has('search') ? $request->input('search') : '';

        //TODO: Only get the latest booking for all talks
        if ($request->has('search')) {
            $talks = Talk::with('lastBooking')
                ->where('theme', 'like', '%' . $request->input('search') . '%')
                ->orWhere('subject', 'like', '%' . $request->input('search') . '%')
                ->orWhere('number', 'like', '%' . $request->input('search') . '%')
                ->orderBy($sort, $order)
                ->paginate();
        } else {
            $talks = Talk::with('lastBooking')->orderBy($sort, $order)->paginate();
        }
        $talks->appends(['sort' => $sort, 'order' => $order, 'search' => $search]);

        return Inertia::render('Talk/Index', ['talks' => $talks, 'search' => $search]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TalkStoreRequest $request)
    {
        $talk = Talk::create($request->validated());

        $request->session()->flash('success', $talk->theme . ' är tillagd');

        return Redirect::route('talks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Talk  $talk
     * @return $talk
     */
    public function show(Talk $talk)
    {
        $talk = Talk::where('id', $talk->id)->with(['speakers' => function ($query) use ($talk) {
            $query->with(['bookings' => function ($q) use ($talk) {
                $q->where('talk_id', $talk->id)->orderBy('date', 'desc')->limit(1);
            }]);
        }])->first();

        return $talk;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Talk  $talk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Talk $talk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Http\Requests\TalkDestroyRequest $request
     * @param  \App\Models\Talk  $talk
     * @return \Illuminate\Http\Response
     */
    public function destroy(TalkDestroyRequest $request, Talk $talk)
    {
        $talk->delete();

        $request->session()->flash('success', $talk->theme . ' är borttagen');

        event(new TalkDelete($talk));

        return Redirect::route('talks.index');
    }
}
