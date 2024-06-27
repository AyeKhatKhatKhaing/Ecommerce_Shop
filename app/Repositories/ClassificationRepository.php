<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ClassificationRepositoryInterface;
use App\Models\Classification;

class ClassificationRepository implements ClassificationRepositoryInterface
{
    public function getAllClassificationList($request)
    {
        $keyword = $request->get('search');
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? "all" : $request->status;

        $classification = Classification::where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('name_hant', 'LIKE', "%$keyword%");
            }

            if ($status != "all") {
                $query->where('status', $status);
            }
        });

        $classification = $classification->with('updateUser')->latest('id')->paginate($perPage);

        $data = [
            'keyword'        => $keyword,
            'perPage'        => $perPage,
            'status'         => $status,
            'classification' => $classification,
        ];

        return $data;
    }

    public function saveClassificationData($request, $id = null)
    {
        $requestData = $request->all();

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $classification            = Classification::findOrFail($id);
            $classification->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $classification              = Classification::create($requestData);
        }

        return $classification;
    }

    public function getClassificationData($id)
    {
        return Classification::findOrFail($id);
    }

    public function deleteClassification($id)
    {
        return Classification::destroy($id);
    }

    public function classificationStatusChange($request)
    {
        $classification = Classification::findOrFail($request->id);
        $classification->update(['status' => !$classification->status]);

        return $classification;
    }
}
