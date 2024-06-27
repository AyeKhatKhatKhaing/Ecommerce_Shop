<?php

namespace App\Repositories;

use App\Interfaces\Repositories\MemberCountryRepositoryInterface;
use App\Models\MemberCountry;

class MemberCountryRepository implements MemberCountryRepositoryInterface
{
    public function getAllMemberCountryList($request)
    {
        $keyword = $request->get('search');
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? "all" : $request->status;

        $membercountry = MemberCountry::with('updateUser')->where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('name_en', 'like', "%$keyword%")
                    ->orWhere('name_hans', 'like', '%keyword%')
                    ->orWhere('name_hant', 'like', '%keyword%');
            }

            if ($status != 'all') {
                $query->where('status', $status);
            }
        })->latest('id')->paginate($perPage);

        $data = [
            'keyword'       => $keyword,
            'perPage'       => $perPage,
            'status'        => $status,
            'membercountry' => $membercountry,
        ];

        return $data;
    }

    public function saveMemberCountryData($request, $id = null)
    {
        $requestData = $request->all();

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $member_country            = MemberCountry::findOrFail($id);
            $member_country->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $member_country              = MemberCountry::create($requestData);
        }

        return $member_country;
    }

    public function getMemberCountryData($id)
    {
        return MemberCountry::findOrFail($id);
    }

    public function deleteMemberCountry($id)
    {
        return MemberCountry::destroy($id);
    }

    public function memberCountryStatusChange($request)
    {
        $membercountry = MemberCountry::findOrFail($request->id);
        $membercountry->update(['status' => !$membercountry->status]);

        return $membercountry;
    }
}
