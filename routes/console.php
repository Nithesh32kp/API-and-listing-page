<?php

use App\Models\Payment;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Schedule::command('hiring:remind-unresponded')
    ->everyMinute()
    ->withoutOverlapping()
    ->onFailure(fn() => \Log::error('hiring reminder failed'))
    ->sendOutputTo(storage_path('logs/schedule.log'));
