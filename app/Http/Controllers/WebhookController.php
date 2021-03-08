<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebhookController extends Controller
{
    public function handleCheckoutSessionCompleted(array $payload)
    {
        $data = $payload['data']['object'];
        ray($data);
        $settings = Settings::findOrFail($data['client_reference_id']);

        DB::transaction(function () use ($data, $settings) {
            $settings->update(['stripe_id' => $data['customer']]);

            $settings->subscriptions()->create([
                'name' => 'default',
                'stripe_id' => $data['subscription'],
                'stripe_status' => 'active'
            ]);
        });

        return $this->successMethod();
    }
}
