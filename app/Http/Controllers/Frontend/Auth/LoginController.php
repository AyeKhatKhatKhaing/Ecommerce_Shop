<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Actions\MemberUpdatePassword;
use App\Events\MemberLoggedIn;
use App\Helpers\AdminHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\MemberLoginRequest;
use App\Models\Member;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $memberUpdatePassword;
    private static $redirectRoute = RouteServiceProvider::MEMBER;

    public function __construct(MemberUpdatePassword $memberUpdatePassword)
    {
        $this->middleware('guest:member')->except('logout');
        $this->memberUpdatePassword = $memberUpdatePassword;
    }

    public function loginForm()
    {
        return view('frontend.auth.login', [
            'method'       => "normal",
        ]);
    }

    public function checkoutloginForm()
    {
        return view('frontend.auth.login', [
            'method'       => "checkout",
        ]);
    }

    public function login(MemberLoginRequest $request)
    {
        $phone = AdminHelper::checkPhoneFormat($request->country_code, $request->phone);

        $login_method = $request->login_method;
        $filter       = $login_method == "email" ? $request->email : $phone;
        $member       = Member::where($login_method, $filter)
            ->where('password', md5($request->password))
            ->first();

        if ($member) {
            $this->memberUpdatePassword->handle($member, $request->password);
        }

        $credentials = $request->login_method == "email" ? $request->safe()->only('email', 'password') : ["phone" => $phone, "password" => $request->password];

        $credentials['status'] = 1;
        $remember    = $request->has('remember-me') ? true : false;
        if (Auth::guard('member')->attempt($credentials, $remember)) {

            MemberLoggedIn::dispatch(auth()->guard('member')->user()); /* event function -> check and update cart */

            return redirect(self::$redirectRoute);
        }

        return back()
            ->withInput($request->only('email', 'password', 'remember', 'login_method'))
            ->withErrors(['invalid' => 'Invalid email or password.']);
    }

    public function logout()
    {
        Auth::guard('member')->logout();

        return redirect()->route('front.home');
    }

}
