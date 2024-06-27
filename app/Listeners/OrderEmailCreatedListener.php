<?php

namespace App\Listeners;

use App\Models\SiteSetting;
use App\Notifications\OrderEmailNotification;
use File;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use PDF;

class OrderEmailCreatedListener
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
        $site_setting    = SiteSetting::where('type', 'contact')->first();

        $contact_email   = $site_setting->options['contact_email'];

        $order  = $event->order ?? null;
        $member = $event->order->member ?? null;

        $pdf = PDF::loadView('mails.order-email-attachment',
            [
                'order'  => $order,
                'member' => $member,
            ]
        )->setPaper('a4');

        $file_path = storage_path('app/public/pdf/' . $order->code . '.pdf');

        if (!File::isDirectory('storage/app/public/pdf/')) {
            Storage::makeDirectory('public/pdf/', 0777, true, true);

            if (!file_exists($file_path)) {
                $pdf->save($file_path);
            }
        }

        $emails = explode(',', $contact_email);

        if ($emails && count($emails) > 0) {
            $emails = array_map(function ($email) {
                return str_replace(' ', '', $email);
            }, $emails);

            Notification::route('mail', $emails)->notify(new OrderEmailNotification($order, $member, $file_path)); /* this is the contact emails address from admin side */
            // foreach($emails as $email) {
            //     Mail::to($email)->send(new SendAdminContactEmails($event->order));
            // }

        }

        Notification::send($event->order, new OrderEmailNotification($event->order, $member, $file_path)); /* this is the order receiver email */
    }
}
