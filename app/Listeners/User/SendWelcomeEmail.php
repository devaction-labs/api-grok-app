<?php

namespace App\Listeners\User;

use App\Events\User\UserRegistered;
use App\Mail\User\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\{Log, Mail};

class SendWelcomeEmail implements ShouldQueue
{
    use Queueable;
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        Log::info('UserRegistered event processed for user: ' . $event->user->email);
        Mail::to($event->user->email)->send(new WelcomeMail($event->user));
    }
}
