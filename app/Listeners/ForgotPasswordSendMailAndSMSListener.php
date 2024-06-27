<?php

namespace App\Listeners;

use App\Events\ForgotPasswordEvent;
use Mail;
use Twilio\Rest\Client;

class ForgotPasswordSendMailAndSMSListener
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
     * @param  \App\Events\ForgotPasswordEvent  $event
     * @return void
     */
    public function handle(ForgotPasswordEvent $event)
    {
        $token      = $event->token;
        $login_type = $event->login_type;
        $member     = $event->member;

        if ($login_type == 'email') {
            Mail::send('mails.email-forgotpassword', ['token' => $token, 'member' => $member], function ($message) use ($member) {
                $message->to($member->email);
                $message->from('info@remfly.com.hk', 'Remfly Wines & Limited');
                $message->subject('Reset Password');
            });
        } else {

            $sms_link = url('reset-password/' . $member->phone . '/' . $token);
            $client   = new Client(config('services.twilio.sid'), config('services.twilio.token'));

            try {
                $client->messages->create(
                    '+'.$member->phone,
                    [
                        'from' => config('services.twilio.phone_number'),
                        'body' => "Click here to reset password: $sms_link",
                    ]
                );
                \Log::info("Success, forgot password OTP => $sms_link");
            } catch (\Exception $e) {
                \Log::error("Failed, forgot password OTP => $sms_link");
            }
        }
    }
}
