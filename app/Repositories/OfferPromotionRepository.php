<?php

namespace App\Repositories;

use App\Interfaces\Repositories\OfferPromotionRepositoryInterface;
use App\Models\OfferPromotion;

class OfferPromotionRepository implements OfferPromotionRepositoryInterface
{
    public function getAllOfferPromotionList($request)
    {
        $keyword = $request->get('search');
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? "all" : $request->status;

        $offerpromotion = OfferPromotion::where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('name_hant', 'LIKE', "%$keyword%");
            }

            if ($status != "all") {
                $query->where('status', $status);
            }
        });

        $offerpromotion = $offerpromotion->with('updateUser')->latest('id')->paginate($perPage);

        $data = [
            'keyword'        => $keyword,
            'perPage'        => $perPage,
            'status'         => $status,
            'offerpromotion' => $offerpromotion,
        ];

        return $data;
    }

    public function saveOfferPromotionData($request, $id = null)
    {
        $requestData = $request->all();

        if ($requestData['amount_type'] == 1) {
            $requestData['is_percent'] = 1;
        } else {
            $requestData['is_percent'] = 0;
        }

        $descriptions = [
            "en"   => $requestData['description_en'],
            'hant' => $requestData['description_hant'],
            'hans' => $requestData['description_hans'],
        ];

        $requestData['descriptions'] = $descriptions;
        $requestData['amount']       = $request->amount ? $request->amount : null;
        $requestData['percent']      = $request->percent ? $request->percent : null;

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $offer_promotion           = OfferPromotion::findOrFail($id);
            $offer_promotion->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $offer_promotion             = OfferPromotion::create($requestData);
        }

        return $offer_promotion;

    }

    public function getOfferPromotionData($id)
    {
        return OfferPromotion::findOrFail($id);
    }

    public function deleteOfferPromotion($id)
    {
        return OfferPromotion::destroy($id);
    }

    public function offerPromotionStatusChange($request)
    {
        $offerpromotion = OfferPromotion::findOrFail($request->id);
        $offerpromotion->update(['status' => !$offerpromotion->status]);

        return $offerpromotion;
    }
}
