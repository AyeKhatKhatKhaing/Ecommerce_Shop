<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected $loginPath = '/letadminin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectTo()
    {

        return redirect('/admin');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if (Str::contains(url()->previous(), ['/member/', '/'.lng().'/member/'])) {
            return redirect()->route('front.login');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            'g-recaptcha-response' => 'required',   
        ], [
            'g-recaptcha-response.required' => 'Google captcha need to verify first.'
        ]);

        $remember = $request->has('remember') ? true : false;

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if (auth()->attempt([$fieldType => $input['email'], 'password' => $input['password']], $remember)) {

            if ($input['email'] == 'laramaster@visibleone.com') {
                return redirect('/admin');
            } else if (auth()->user()->hasRole('Editor') || auth()->user()->hasRole(strtolower('Editor')) || auth()->user()->hasRole(strtoupper('Editor'))) {
                return redirect('/admin/home');
            } else {
                return redirect('/admin/member');
            }
                
        } else {
            return redirect()->back()
                ->with('error', 'Your Credentials are invalid');
        }
    }

    public function logout()
    {
        if(Auth::check()) {
            Auth::logout();
        }
        return redirect('/letadminin');
    }
}
