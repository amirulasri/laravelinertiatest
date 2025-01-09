<?php

namespace App\Jobs;

use App\Models\Contact;
use App\Models\User;
use App\Notifications\BirthdayWish;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TestBirthdayEmail implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $contact;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, Contact $contact)
    {
        $this->user = $user;
        $this->contact = $contact;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify(new BirthdayWish($this->contact));
    }
}
