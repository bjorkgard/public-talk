<?php

namespace App\Http\Controllers;

use App\Models\Chairman;
use App\Http\Requests\ChairmanStoreRequest;
use App\Http\Requests\ChairmanUpdateRequest;
use App\Repositories\CountryRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChairmanController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CountryRepository $repo)
    {
        $sort = $request->has('sort') ? $request->input('sort') : 'name';
        $order = $request->has('order') ? $request->input('order') : 'asc';

        $chairmen = Chairman::with('lastBooking')->orderBy($sort, $order)->paginate();
        $chairmen->appends(['sort' => $sort, 'order' => $order]);

        $countries = $repo->getAllCountryCodes();

        return Inertia::render('Chairman/Index', compact('chairmen', 'countries'));
    }

    /**
     * @param \App\Http\Requests\ChairmanStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChairmanStoreRequest $request)
    {
        $chairman = Chairman::create($request->validated());

        $request->session()->flash('success', $chairman->name . ' är tillagd');

        return redirect()->route('chairmen.index');
    }

    /**
     * @param \App\Http\Requests\ChairmanUpdateRequest $request
     * @param \App\Models\Chairman $chairman
     * @return \Illuminate\Http\Response
     */
    public function update(ChairmanUpdateRequest $request, Chairman $chairman)
    {
        $chairman->update($request->validated());

        $request->session()->flash('success', $chairman->name . ' är uppdaterad');

        return redirect()->route('chairmen.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Chairman $chairman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Chairman $chairman)
    {
        $chairman->delete();

        $request->session()->flash('success', 'Ordöranden är raderad');

        return redirect()->route('chairmen.index');
    }
}
