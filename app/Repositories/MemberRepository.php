<?php

namespace App\Repositories;

use App\Helpers\AdminHelper;
use App\Helpers\DataArrayHelper;
use App\Interfaces\Repositories\MemberRepositoryInterface;
use App\Models\BusinessType;
use App\Models\Member;
use App\Models\MemberCountry;

class MemberRepository implements MemberRepositoryInterface
{
    public function getAllMemberList($request)
    {
        $keyword            = $request->get('search');
        $perPage            = $request->display ? $request->display : 10;
        $status             = $request->status == null ? "all" : $request->status;
        $member_type_filter = $request->member_type_filter == null ? "all" : $request->member_type_filter;
        $member_types       = DataArrayHelper::getMemberType();

        $member = Member::with(['updateUser', 'member_type'])->where(function ($query) use ($keyword, $status, $member_type_filter) {
            if ($keyword != null) {
                $query->where('code', 'LIKE', "%$keyword%")
                    ->orWhere('first_name', 'LIKE', "%$keyword%")
                    ->orWhere('last_name', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%")
                    ->orWhereHas('member_type', function ($que) use ($keyword) {
                        $que->where('name_en', 'LIKE', "%$keyword%");
                    });
            }

            if ($status != "all") {
                $query->where('status', $status);
            }

            if ($member_type_filter != "all") {
                $query->where('member_type_id', $member_type_filter);
            }
        });

        if (!$request->export) {
            $member = $member->latest('updated_at')->paginate($perPage);
        }

        $data = [
            'keyword'            => $keyword,
            'status'             => $status,
            'perPage'            => $perPage,
            'member_type_filter' => $member_type_filter,
            'member_types'       => $member_types,
            'member'             => $member,
        ];

        return $data;
    }

    public function createMemberPage()
    {
        $member_types   = DataArrayHelper::getMemberType();
        $countries      = MemberCountry::where('status', true)->pluck('name_en', 'id');
        $business_types = BusinessType::active()->pluck('name_hant', 'name_hant');

        $data = [
            'member_types'   => $member_types,
            'countries'      => $countries,
            'business_types' => $business_types,
        ];

        return $data;
    }

    public function saveMemberData($request, $id = null)
    {
        $requestData         = $request->all();
        $requestData['code'] = AdminHelper::getMemberCode();

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $member                    = Member::findOrFail($id);
            $member->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;

            $member = Member::create($requestData);
        }

        return $member;
    }

    public function getMemberData($id)
    {
        $member_types   = DataArrayHelper::getMemberType();
        $countries      = MemberCountry::where('status', true)->pluck('name_en', 'id');
        $member         = Member::findOrFail($id);
        $business_types = BusinessType::active()->pluck('name_hant', 'name_hant');

        $data = [
            'member_types'   => $member_types,
            'countries'      => $countries,
            'member'         => $member,
            'business_types' => $business_types,
        ];

        return $data;
    }

    public function deleteMember($id)
    {
        $member = Member::find($id);
        $member->update(['status' => -1]);

        return Member::destroy($id);
    }

    public function memberStatusChange($request)
    {
        $member = Member::findOrFail($request->id);
        $member->update(['status' => !$member->status]);

        return $member;
    }
}
