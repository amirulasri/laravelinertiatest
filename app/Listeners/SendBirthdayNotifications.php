<?php

namespace App\Listeners;

use App\Events\BirthdaySent;
use App\Models\Contact;
use App\Notifications\BirthdayWish;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBirthdayNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BirthdaySent $event): void
    {
        $contact = Contact::where('id', $event->contact->id)->first();
        $contact->notify(new BirthdayWish($event->contact));
    }
}
