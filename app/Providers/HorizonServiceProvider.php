<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Horizon::routeSmsNotificationsTo('15556667777');
        Horizon::routeMailNotificationsTo(env('HORIZON_MAIL'));
        Horizon::routeSlackNotificationsTo(env('HORIZON_SLACK'), '#horizon');

        // Horizon::night();
    }

    /**
     * Register the Horizon gate.
     *
     * This gate determines who can access Horizon in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewHorizon', function ($user = null) {
            if (empty($user)) {
                return request()->bearerToken() === config('services.horizon.secret');
            } else {
                return in_array($user->email, [
                    'nathanael@bjorkgard.se',
                ]);
            }
        });
    }
}
