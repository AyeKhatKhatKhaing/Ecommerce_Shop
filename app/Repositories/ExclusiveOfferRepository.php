<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ExclusiveOfferRepositoryInterface;
use App\Models\ExclusiveOffer;

class ExclusiveOfferRepository implements ExclusiveOfferRepositoryInterface
{
    public function getAllExclusiveOfferList($request)
    {
        $keyword = $request->get('search');
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? "all" : $request->status;

        $exclusiveoffer = ExclusiveOffer::where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('titles', 'LIKE', "%$keyword%");
            }

            if ($status != "all") {
                $query->where('status', $status);
            }
        });

        $exclusiveoffer = $exclusiveoffer->with('updateUser')->latest('id')->paginate($perPage);

        $data = [
            'keyword'        => $keyword,
            'perPage'        => $perPage,
            'status'         => $status,
            'exclusiveoffer' => $exclusiveoffer,
        ];

        return $data;
    }

    public function saveExclusiveOfferData($request, $id = null)
    {
        $requestData = $request->all();

        $titles = [
            'en'   => $requestData['title_en'],
            'hant' => $requestData['title_hant'],
            'hans' => $requestData['title_hans'],
        ];

        $descriptions = [
            'en'   => $requestData['description_en'],
            'hant' => $requestData['description_hant'],
            'hans' => $requestData['description_hans'],
        ];

        $requestData['titles']       = $titles;
        $requestData['descriptions'] = $descriptions;

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $exclusiveoffer            = ExclusiveOffer::findOrFail($id);
            $exclusiveoffer->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $exclusiveoffer              = ExclusiveOffer::create($requestData);
        }

    }

    public function getExclusiveOfferData($id)
    {
        return ExclusiveOffer::findOrFail($id);
    }

    public function deleteExclusiveOffer($id)
    {
        return ExclusiveOffer::destroy($id);
    }

    public function exclusiveOfferStatusChange($request)
    {
        $exclusiveoffer = ExclusiveOffer::findOrFail($request->id);
        $exclusiveoffer->update(['status' => !$exclusiveoffer->status]);

        return $exclusiveoffer;
    }
}
