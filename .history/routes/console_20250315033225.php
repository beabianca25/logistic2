<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


use Illuminate\Support\Facades\Schedule;

Schedule::command('auction:notify-highest-bid')->dailyAt('00:00'); // Runs at midnight
