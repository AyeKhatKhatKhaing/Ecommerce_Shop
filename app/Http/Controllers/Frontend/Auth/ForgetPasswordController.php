<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Events\ForgotPasswordEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ForgetPasswordRequest;
use App\Http\Requests\Frontend\ResetPasswordRequest;
use App\Models\Member;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function index()
    {
        return view('frontend.auth.forgot_password');
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $token = Str::random(15);

        $type   = ($request->login_type == 'email') ? $request->email : $request->format_phone;
        $member = ($request->login_type == 'email') ? Member::where('email', $request->email)->first() : Member::where('phone', $request->format_phone)->first();

        $data = DB::table('password_resets')->where('email', $type)->first();

        if (!$data) {
            DB::table('password_resets')->insert([
                'email'      => $type,
                'token'      => $token,
                'created_at' => Carbon::now(),
            ]);
        } else {
            DB::table('password_resets')->where('email', $type)->update([
                'token' => $token,
            ]);
        }

        /* Mail & SMS event */
        ForgotPasswordEvent::dispatch($token, $request->login_type, $member);

        $message = ($request->login_type == 'email') ? 'We have e-mailed your password reset link!' : 'Success!, OTP sent to your phone.';

        return back()->with('message', $message);
    }

    public function getResetPassoword($type = null, $token = null)
    {
        $password_reset = DB::table('password_resets')->where(['email' => $type, 'token' => $token])->first();

        if (!$password_reset) {
            return redirect()->route('front.forget.password')->with('warning', 'Invalid token');
        }

        return view('frontend.auth.reset_password', ['token' => $token, 'email' => $type]);
    }

    public function submitResetPasswordForm(ResetPasswordRequest $request)
    {
        $password_reset = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();

        if (!$password_reset)
            return redirect()->back()->with('warning', 'Invalid token');

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $member = Member::where('phone', $request->email)->first();
        } else {
            $member = Member::where('email', $request->email)->first();
        }

        if ($member) {
            $member->update(['password' => $request->password]);

            DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->delete();

            return redirect('/member-login')->with('message', 'Your password has been changed!');
        }

        return redirect('/member-login')->with('warning', 'Please try again!');
    }
}
