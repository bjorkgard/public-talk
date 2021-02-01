<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsMeetingRequest;
use App\Models\Settings;
use Illuminate\Support\Facades\Redirect;

class SettingsMeetingController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SettingsMeetingRequest  $request
     * @param  int  $setting
     * @return \Inertia\Inertia render
     */
    public function update(SettingsMeetingRequest $request, $setting)
    {
        $settings = Settings::find($setting);
        $settings->meeting = $request->validated();
        $settings->save();

        return Redirect::route('settings.index');
    }
}
