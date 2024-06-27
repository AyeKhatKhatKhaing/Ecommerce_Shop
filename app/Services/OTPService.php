<?php

namespace App\Services;

use App\Models\OtpCode;
use Carbon\Carbon;
use Twilio\Rest\Client;
use DB;

class OTPService
{
    protected $client;

    public function sendVerificationCode($phone, $otpCode = 123456)
    {
        $client  = new Client(config('services.twilio.sid'), config('services.twilio.token'));
        // Send SMS
        try {
            $client->messages->create(
                "+".$phone,
                [
                    'from' => config('services.twilio.phone_number'),
                    'body' => "Your OTP code is: $otpCode",
                ]
            );
            $status = true;
        } catch (\Exception $e) {
            // Handle Twilio API error
            $status = false;
        }

        return $status;

    }

    public function verifyOtp($phone, $otp)
    {
        $code = OtpCode::where('phone', $phone)->first();
        if ($code->code == $otp) {
            $code->update(["is_verify" => true]);

            return response()->json(['status' => true, 'message' => 'Verified!'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Wrong OTP Code!'], 404);
        }

    }

    public function checkBanTime($phone)
    {
        $member = DB::table('members')->where('phone', $phone)->where('status', 1)->first();

        if($member) {
            return response()->json(['status' => false, 'message' => 'Phone number already defined in system.'], 200);
        }

        $otpCode = rand(100000, 999999);

        $otp = OtpCode::where('phone', $phone)->first();

        if ($otp) {
            $request_count  = $otp->request_count + 1;
            $ban_time       = $otp->ban_time;
            $now            = now()->format('Y-m-d H:i:s');
            $add_time       = Carbon::parse($ban_time)->addMinutes(5)->format('Y-m-d H:i:s');

            if($otp->request_count >= 3) {
                if($now > $add_time) {
                    $status = $this->sendVerificationCode($phone, $otpCode);

                    $otp->update(['code' => $otpCode, 'request_count' => 1, 'ban_time' => null]);

                    $message   = $status ? 'OTP sent successful.': 'OTP sent fail.';
                    
                } else {
                    $to            = Carbon::parse(now());
                    $min           = $to->diffInMinutes($ban_time);
                    $diff_in_min   = ($min != 5) ? 5 - $min : $min;

                    $status    = false;
                    $message   = 'Please try again after '. $diff_in_min . ' minutes.';
                }  
            } else {
                $status    = $this->sendVerificationCode($phone, $otpCode);
                $message   = $status ? 'OTP sent successful.': 'OTP sent fail.';
                $otp->update([
                    "code"          => $otpCode,
                    "request_count" => $request_count >= 3 ? 3 : $request_count,
                    "ban_time"      => $request_count >= 3 ? Carbon::now() : null,
                ]);

            }

            return response()->json(['status' => $status, 'message' => $message], 200);

        } else {
            $status    = $this->sendVerificationCode($phone, $otpCode);
            $message   = $status ? 'OTP sent successful.': 'OTP sent fail.';
            OtpCode::create([
                "phone"         => $phone,
                "code"          => $otpCode,
                "request_count" => 1,
            ]);

            return response()->json(['status' => $status, 'message' => $message], 200);
        }

    }
}
