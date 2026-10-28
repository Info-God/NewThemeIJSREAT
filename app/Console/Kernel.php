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
        \App\Console\Commands\GenerateSitemap::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Generate sitemap every 3 days at 2:00 AM
        $schedule->command('sitemap:generate')
            ->everyThreeDays()
            ->at('02:00')
            ->withoutOverlapping(10)      // Wait 10 min before killing if stuck
            ->runInBackground()            // Run in background to not block other tasks
            ->appendOutputTo(storage_path('logs/sitemap-generator.log'))
            ->onFailure(function () {
                \Log::error('❌ Sitemap generation failed! Check sitemap-generator.log');
            });
        
        // Optional: Clear old log files (keep last 30 days)
        $schedule->command('log:clear')->monthly();
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