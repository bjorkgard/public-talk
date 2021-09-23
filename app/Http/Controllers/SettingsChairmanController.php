<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsChairmanRequest;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingsChairmanController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SettingsExtraRequest  $request
     * @param  int  $setting
     * @return \Inertia\Inertia render
     */
    public function update(SettingsChairmanRequest $request, $setting)
    {
        $settings = Settings::find($setting);
        $settings->chairman = $request->validated();
        $settings->save();

        return Redirect::route('settings.index');
    }
}
