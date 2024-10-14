<?php

declare(strict_types=1);

use App\Console\Commands\Ping;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function (): void {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(
    command: Ping::class,
)->everyMinute()->withoutOverlapping()->onOneServer();
