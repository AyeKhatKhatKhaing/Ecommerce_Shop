<?php

namespace App\Listeners;

use App\Events\MemberRegistered;
use App\Notifications\MemberNotification;
use Illuminate\Support\Facades\Notification;

class SendRegisterMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\MemberRegistered  $event
     * @return void
     */
    public function handle(MemberRegistered $event)
    {
        Notification::send($event->member, new MemberNotification($event->member));
    }
}
