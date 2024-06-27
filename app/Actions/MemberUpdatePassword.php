<?php

namespace App\Actions;

use App\Models\Member;

class MemberUpdatePassword
{
    public function handle(Member $member, $password)
    {
        $member->update(['password' => $password]);
    }
}
