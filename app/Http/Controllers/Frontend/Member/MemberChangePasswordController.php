<?php

namespace App\Http\Controllers\Frontend\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ChangeMemberPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberChangePasswordController extends Controller
{
    public function memberChangePassword()
    {
        return view('frontend.member.change_password.index');
    }

    public function memberUpdatePassword(ChangeMemberPasswordRequest $request)
    {
        $member = auth('member')->user();

        if (!Hash::check($request->current_password, $member->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $member->update([
            'password' => $request->new_password,
        ]);

        return redirect()->back()->with('success', 'Password changed successfully.');
    }

}
