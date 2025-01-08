<?php

use App\Jobs\SendBirthdayWish;
use App\Models\Contact;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Schedule::job(new SendBirthdayWish(Contact::find(13)))->everyFiveMinutes();
Schedule::call(function () {
    foreach (Contact::whereMonth('birthdate', now()->format('m'))->whereDay('birthdate', now()->format('d'))->cursor() as $contact) {
        SendBirthdayWish::dispatch($contact);
    }
})->daily();