<?php

namespace App\Listeners\User;

use App\Events\User\UserLoggedIn;
use App\Mail\User\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(UserLoggedIn $event): void
    {
        Mail::to($event->user->email)->send(new WelcomeMail($event->user));
    }
}
