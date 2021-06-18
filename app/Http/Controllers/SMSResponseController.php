<?php

namespace App\Http\Controllers;

use App\Models\MessageLog;
use App\Repositories\Php46Elks\Php46ElksClient;
use Illuminate\Http\Request;

class SMSResponseController extends Controller
{
    public function __invoke(Request $request)
    {
        $messageLog = MessageLog::where('to', $request->input('from'))
            ->where('from', $request->input('to'))
            ->with('user')
            ->latest()
            ->first();

        if ($messageLog) {
            $php46ElksClient = new Php46ElksClient(config('services.46elks.username'), config('services.46elks.password'));
            $sms = $php46ElksClient->sms()->SMSDispatcher();

            $response = $sms->from($request->input('from'))
                ->recipient($messageLog->user->phone)
                ->line($request->input('message'))
                ->send();

            $messageLog->user->settings->subscription('default')->reportUsageFor(config('services.stripe.sms'), $response[0]['parts']);
        }
    }
}
