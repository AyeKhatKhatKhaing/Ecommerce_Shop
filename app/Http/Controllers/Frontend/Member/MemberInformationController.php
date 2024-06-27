<?php

namespace App\Http\Controllers\Frontend\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UpdateMemberInfoRequest;
use App\Models\MemberCountry;

class MemberInformationController extends Controller
{
    public function memberInformation()
    {
        $countries = MemberCountry::where('status', true)->get();
        return view('frontend.member.information.index', compact('countries'));
    }

    public function updateMemberInformation(UpdateMemberInfoRequest $request)
    {
        $member = auth('member')->user();

        if ($member) {
            $member->update([
                "first_name"     => strip_tags($request->first_name),
                "last_name"      => strip_tags($request->last_name),
                "company"        => strip_tags($request->company_name),
                "country_id"     => $request->country_id,
                "address"        => strip_tags($request->address),
                "address_detail" => strip_tags($request->address_detail),
                "city"           => strip_tags($request->city),
                "state"          => strip_tags($request->state),
                "postal_code"    => strip_tags($request->postal_code),
                "email"          => strip_tags($request->email),
                "phone"          => strip_tags($request->phone),
                "country_code"   => strip_tags($request->country_code),

            ]);
        }

        return redirect()->back()->with("success", "Member Information Update Successfully!");
    }
}
