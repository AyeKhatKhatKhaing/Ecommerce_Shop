<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PromotionRepositoryInterface;
use App\Models\Promotion;

class PromotionRepository implements PromotionRepositoryInterface
{
    public function getAllPromotionList($request)
    {
        $keyword = $request->get('search');
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? "all" : $request->status;

        $promotion = Promotion::with('updateUser')->where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('name_hant', 'LIKE', "%$keyword%");
            }

            if ($status != "all") {
                $query->where('status', $status);
            }
        });

        $promotion = $promotion->latest('id')->paginate($perPage);

        $data = [
            'keyword'   => $keyword,
            'perPage'   => $perPage,
            'status'    => $status,
            'promotion' => $promotion,
        ];

        return $data;
    }

    public function savePromotionData($request, $id = null)
    {
        $requestData = $request->all();

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $promotion                 = Promotion::findOrFail($id);
            $promotion->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $promotion                   = Promotion::create($requestData);
        }

        return $promotion;
    }

    public function getPromotionData($id)
    {
        return Promotion::findOrFail($id);
    }

    public function deletePromotion($id)
    {
        return Promotion::destroy($id);
    }

    public function promotionStatusChange($request)
    {
        $promotion = Promotion::findOrFail($request->id);
        $promotion->update(['status' => !$promotion->status]);

        return $promotion;
    }
}
