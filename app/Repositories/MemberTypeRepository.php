<?php

namespace App\Repositories;

use App\Interfaces\Repositories\MemberTypeRepositoryInterface;
use App\Models\MemberType;

class MemberTypeRepository implements MemberTypeRepositoryInterface
{
    public function getAllMemberTypeList($request)
    {
        $keyword = $request->get('search');
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? "all" : $request->status;

        $query = MemberType::query()->latest('id');

        $membertype = $query->where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('name_hant', 'like', '%' . $keyword . '%');
            }
            if ($status != "all") {
                $query->where('status', $status);
            }
        });

        $membertype = $membertype->with('updateUser')->paginate($perPage);

        $data = [
            'keyword'    => $keyword,
            'status'     => $status,
            'perPage'    => $perPage,
            'membertype' => $membertype,
        ];

        return $data;
    }

    public function saveMemberTypeData($request, $id = null)
    {
        $requestData  = $request->all();
        $descriptions = [
            "en"   => $requestData['description_en'],
            'hant' => $requestData['description_hant'],
            'hans' => $requestData['description_hans'],
        ];

        $requestData['descriptions'] = $descriptions;

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $membertype                = MemberType::findOrFail($id);
            $membertype->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $membertype                  = MemberType::create($requestData);
        }

        return $membertype;
    }

    public function getMemberTypeData($id)
    {
        return MemberType::findOrFail($id);
    }

    public function deleteMemberType($id)
    {
        return MemberType::destroy($id);
    }

    public function memberTypeStatusChange($request)
    {
        $membertype = MemberType::findOrFail($request->id);
        $membertype->update(['status' => !$membertype->status]);

        return $membertype;
    }
}
