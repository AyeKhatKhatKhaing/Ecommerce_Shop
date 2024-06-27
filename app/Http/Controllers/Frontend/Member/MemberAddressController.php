<?php

namespace App\Http\Controllers\Frontend\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberAddressController extends Controller
{
    public function memberAddress()
    {
        $member_address = Member::getAddress();
        return view('frontend.member.address.index', compact('member_address'));
    }

    public function storeMemberAddress(Request $request)
    {
        $memberId = auth('member')->user()->id;
        $request->merge(['created_date' => now(), 'member_id' => $memberId]);

        $requestData = $request->all();
        $address     = [
            "first_name"     => strip_tags(trim($requestData['first_name'])) ?? '',
            "last_name"      => strip_tags(trim($requestData['last_name'])) ?? '',
            "email"          => strip_tags(trim($requestData['email'])) ?? '',
            "address"        => strip_tags(trim($requestData['address'])) ?? '',
            "address_detail" => strip_tags(trim($requestData['address_detail'])) ?? '',
            "phone"          => strip_tags(trim($requestData['phone'])) ?? '',
            "country_code"   => strip_tags(trim($requestData['country_code'])) ?? '',
        ];

        $request->billing_address ? $requestData['billing_address'] = $address : $requestData['shipping_address'] = $address;

        $member_address = MemberAddress::where('member_id', $memberId)->first();
        if ($member_address) {
            $member_address->update([
                "shipping_address" => $request->shipping_address ? $requestData['shipping_address'] : $member_address->shipping_address,
                "billing_address"  => $request->billing_address ? $requestData['billing_address'] : $member_address->billing_address,
            ]);
        } else {
            MemberAddress::create([
                'member_id'        => $memberId,
                "shipping_address" => $request->shipping_address ? $requestData['shipping_address'] : null,
                "billing_address"  => $request->billing_address ? $requestData['billing_address'] : null,
            ]);
        }

        return redirect()->back()->with('success', 'Member Address Updated Successfully.');
    }

    public function getMember()
    {
        return Auth::guard('member')->user();
    }

}
