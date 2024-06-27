<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NewsletterNotification;
use Illuminate\Support\Facades\Notification;

class NewsletterCreatedListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // dd($event->data);
        Notification::send($event->data, new NewsletterNotification($event->data));
        // $event->data->notify(new NewsletterNotification($event->data));
    }
}
