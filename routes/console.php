<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    \App\Models\GoogleConnection::query()
        ->whereNotNull('spreadsheet_id')
        ->each(function ($connection) {
            app(\App\Http\Controllers\GoogleSheetController::class)
                ->syncForConnection($connection);
        });
})->everyFiveMinutes();
