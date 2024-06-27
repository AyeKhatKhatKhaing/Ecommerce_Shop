<?php

namespace App\Listeners;

use App\Events\MemberRegistered;
use App\Notifications\MemberNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class AssignMemberType
{
    use Notifiable;

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
     * @param  \App\Events\MemberRegistered  $event
     * @return void
     */
    public function handle(MemberRegistered $event)
    {
        $member      = $event->member;
        $member_type = DB::table('member_types')->where('name_en', 'Silver')->first();

        if ($member_type) {
            $member->update(['member_type_id' => $member_type->id]);
        }
    }
}
