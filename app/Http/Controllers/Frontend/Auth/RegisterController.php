<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Events\MemberRegistered;
use App\Helpers\AdminHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\MemberRegisterRequest;
use App\Models\BusinessType;
use App\Models\Member;
use App\Models\SiteSetting;
use App\Services\OTPService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $OTPService;
    public function __construct(OTPService $service)
    {
        $this->middleware('guest:member');
        $this->OTPService = $service;
    }

    public function registerForm()
    {
        $business_types = BusinessType::where('status', true)->get();
        $site_setting   = SiteSetting::where('type', 'register')->first();

        return view('frontend.auth.register', compact('business_types', 'site_setting'));
    }

    public function register(MemberRegisterRequest $request)
    {
        $requestData                      = [];
        $requestData['code']              = AdminHelper::getMemberCode();
        $requestData['ip_address']        = $request->ip();
        $requestData['account_type']      = $request->account_type;
        $requestData['is_term_condition'] = $request->is_term_condition ? $request->is_term_condition : $request->com_is_term_condition;
        $requestData['is_marketing']      = $request->is_marketing ? $request->is_marketing : $request->com_is_marketing;
        $requestData['created_date']      = Carbon::now();
        // $member                           = Member::where('status', '!=', 1)->withTrashed();

        if ($request->account_type == 'individual') {
            $requestData['first_name']        = $request->first_name;
            $requestData['last_name']         = $request->last_name;
            $requestData['dob']               = $request->dob == "" ? null : $request->dob;
            $requestData['email']             = $request->email;
            $requestData['country_code']      = $request->country_code;
            $requestData['phone']             = ($request->phone && ($request->phone != $request->country_code) ) ? AdminHelper::checkPhoneFormat($request->country_code, $request->phone) : null;
            $requestData['password']          = $request->password;

            $member = Member::where('status', '!=', 1)->withTrashed()->where('email', $request->email)->orWhere('phone', AdminHelper::checkPhoneFormat($request->country_code, $request->phone))->first();

        }

        if ($request->account_type == 'company') {
            $requestData['first_name']        = $request->com_first_name;
            $requestData['last_name']         = $request->com_last_name;
            $requestData['company']           = $request->company_name;
            $requestData['company_website']   = $request->company_website;
            $requestData['business_type']     = $request->business_type ?? null;
            $requestData['dob']               = $request->com_dob == "" ? null : $request->com_dob;
            $requestData['email']             = $request->com_email;
            $requestData['country_code']      = $request->com_country_code;
            $requestData['phone']             = ($request->com_phone && ($request->com_phone != $request->com_country_code) ) ? AdminHelper::checkPhoneFormat($request->com_country_code, $request->com_phone) : null;
            $requestData['password']          = $request->com_password;

            $member   =  Member::where('status', '!=', 1)->withTrashed()->where('email', $request->com_email)->orWhere('phone', AdminHelper::checkPhoneFormat($request->com_country_code, $request->com_phone))->first();
                            
        }

        if (isset($member)) {
            $requestData['status']          = 1;
            $requestData['deleted_at']      = null;
            $requestData['member_type_id']  = 1;
            $member->update($requestData);
        } else {
            $member  = Member::create($requestData);
            /* assign member type & welcome coupon function */
            MemberRegistered::dispatch($member);
        }

        return redirect()->route('front.login');
    }

    public function getOTP(Request $request)
    {
        /* chect ban time and get otp */
        return $this->OTPService->checkBanTime($request->phone_number);
    }

    public function verifyOTP(Request $request)
    {
        $phone    = $request->phone;
        $otp_code = $request->otp_code;
        return $this->OTPService->verifyOtp($phone, $otp_code);
    }

}
