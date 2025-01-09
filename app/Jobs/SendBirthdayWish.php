<?php

namespace App\Jobs;

use App\Models\Contact;
use App\Notifications\BirthdayWish;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendBirthdayWish implements ShouldQueue
{
    use Queueable;

    protected $contact;

    /**
     * Create a new job instance.
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send birthday wish to the user
        $this->contact->notify(new BirthdayWish($this->contact));
    }
}
