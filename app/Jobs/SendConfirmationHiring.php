<?php

namespace App\Jobs;

use App\Models\HiringUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendConfirmationHiring implements ShouldQueue
{
    use Queueable;

    public function __construct(public HiringUser $hiringUser)
    {
    }

    public function handle(): void
    {
        Mail::raw(
            "Hi {$this->hiringUser->name}, thanks for contacting us. We'll get back to you soon.",
            fn($m) => $m->to($this->hiringUser->email)->subject('We received your details')
        );
    }
}
