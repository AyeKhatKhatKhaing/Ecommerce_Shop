<?php

namespace App\Listeners;

use App\Events\MemberRegistered;
use App\Notifications\CouponNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Twilio\Rest\Client;

class AssignCoupon
{
    use Notifiable;

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
        $member = $event->member;
        $coupon = DB::table('coupons')->where('coupon_type', 'new')->where('status', true)->first();

        if ($coupon) {
            $member->coupon_histories()->create([
                'coupon_id'   => $coupon->id,
                'start_date'  => $coupon->start_date,
                'expiry_date' => $coupon->expiry_date,
            ]);

            /* if member signup with phone will send compon sms */
            if(empty($member->email) && $member->phone) {
                $client  = new Client(config('services.twilio.sid'), config('services.twilio.token'));
                $message = "You may enjoy ";
                $message .= ($coupon->discount_type == 'amount' ? $coupon->amount . ' amount' : $coupon->percent . '%');
                $message .= " OFF for your next purchase.";
                $message .= " Your coupon code is ". $coupon->code;

                try {
                    $client->messages->create(
                        '+' . $member->phone,
                        [
                            'from' => config('services.twilio.phone_number'),
                            'body' => $message,
                        ]
                    );
                    \Log::info("Success, welcome coupon sms $member->code => $coupon->code");
                } catch (\Exception $e) {
                    \Log::error("Failed, welcome coupon sms $member->code => $coupon->code");
                }
            }

            Notification::send($member, new CouponNotification($member, $coupon));
        }
    }
}
