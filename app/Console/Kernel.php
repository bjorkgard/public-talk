<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('telescope:prune')->daily()->environments(['local']);
        $schedule->command('horizon:snapshot')->everyFiveMinutes()->environments(['production']);

        $schedule->command('pt:remind-speaker')->dailyAt('10:00')->pingOnSuccess('http://beats.envoyer.io/heartbeat/BO8elh9WGDGB7Iq');
        $schedule->command('pt:chairman')->dailyAt('11:00')->pingOnSuccess('http://beats.envoyer.io/heartbeat/2QcV2UKXjdNN5VS');
        $schedule->command('pt:send-thanks')->dailyAt('09:00')->pingOnSuccess('http://beats.envoyer.io/heartbeat/grM1rShpGrHLY9s');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
