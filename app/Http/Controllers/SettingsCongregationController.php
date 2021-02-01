<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsCongregationRequest;
use App\Models\Settings;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SettingsCongregationController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SettingsCongregationRequest  $request
     * @param  int  $setting
     * @return \Inertia\Inertia render
     */
    public function update(SettingsCongregationRequest $request, $setting)
    {
        $settings = Settings::find($setting);
        $settings->congregation = $request->validated();
        $settings->save();

        return Redirect::route('settings.index');
    }
}
