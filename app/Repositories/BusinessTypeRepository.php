<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BusinessTypeRepositoryInterface;
use App\Models\BusinessType;

class BusinessTypeRepository implements BusinessTypeRepositoryInterface
{
    public function getAllBusinessTypeList($request)
    {
        $keyword = $request->search;
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? 'all' : $request->status;

        $types = BusinessType::with('updateUser')->where(function ($query) use ($keyword, $status) {
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
            'keyword' => $keyword,
            'perPage' => $perPage,
            'status'  => $status,
            'types'   => $types,
        ];

        return $data;
    }

    public function saveBusinessTypeData($request, $id = null)
    {
        $requestData = $request->all();

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $business_type             = BusinessType::findOrFail($id);
            $business_type->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $business_type               = BusinessType::create($requestData);
        }

        return $business_type;
    }

    public function getBusinessTypeData($id)
    {
        return BusinessType::findOrFail($id);
    }

    public function deleteBusinessType($id)
    {
        return BusinessType::destroy($id);
    }

    public function businessTypeStatusChange($request)
    {
        $type = BusinessType::findOrFail($request->id);
        $type->update(['status' => !$type->status]);

        return $type;
    }
}
