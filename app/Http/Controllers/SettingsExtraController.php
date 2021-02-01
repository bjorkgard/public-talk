<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsExtraRequest;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingsExtraController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SettingsExtraRequest  $request
     * @param  int  $setting
     * @return \Inertia\Inertia render
     */
    public function update(SettingsExtraRequest $request, $setting)
    {
        $settings = Settings::find($setting);
        $settings->extra = $request->input('extra');
        $settings->save();

        return Redirect::route('settings.index');
    }
}
