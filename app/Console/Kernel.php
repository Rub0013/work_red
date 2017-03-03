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
        Commands\Inspire::class,
        Commands\PostsSchedule::class,
        Commands\UpdateSubreddits::class,
        Commands\UpdateArchiveSubreddits::class,
        Commands\UpdateArchivePosts::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command('inspire')
//                 ->hourly();
        $schedule->command('posts:schedule')
            ->everyTenMinutes();
        $schedule->command('archive_subreddits:update')
            ->everyFiveMinutes();
        $schedule->command('archive_posts:update')
            ->everyFiveMinutes();
        $schedule->command('subreddits:update')->daily();
    }
}
