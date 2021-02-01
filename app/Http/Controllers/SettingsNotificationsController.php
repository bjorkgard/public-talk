<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsNotificationsRequest;
use App\Models\Settings;
use Illuminate\Support\Facades\Redirect;

class SettingsNotificationsController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SettingsMeetingRequest  $request
     * @param  \App\Models\Settings  $setting
     * @return \Inertia\Inertia render
     */
    public function update(SettingsNotificationsRequest $request, Settings $setting)
    {
        $setting->notifications = $request->validated();
        $setting->save();

        return Redirect::route('settings.index');
    }
}
