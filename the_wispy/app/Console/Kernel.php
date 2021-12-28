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
        // Commands\VerifySubscription::class,
        // Commands\AutoPayment::class,
        // Commands\CheckExpiredUsersScheduler::class,

        Commands\NotifyUserAboutPlanExpiry::class,
        Commands\CountAgentMonthlyCommision::class,
        Commands\CheckExpiredUsersScheduler::class,
            
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:notify_users_about_expiry')->cron('* * * * *' );
        $schedule->command('command:remove_users_data_after_expiry')->cron('* * * * *');
        // $schedule->command('command:count_agent_monthly_commission')->cron();

           // $schedule->command('inspire')
        //    ->hourly();   
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
