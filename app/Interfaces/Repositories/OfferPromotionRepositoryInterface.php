<?php

namespace App\Interfaces\Repositories;

interface OfferPromotionRepositoryInterface
{
    /**
     * get the offer promotion list
     * @param $request
     * @return $data[]
     */
    public function getAllOfferPromotionList($request);

    /**
     * get the request data
     * @param $request, $id
     * @return $offer_promotion
     */
    public function saveOfferPromotionData($request, $id);

    /**
     * get the offer promotion by id
     * @param $id
     * @return $offerpromotion
     */
    public function getOfferPromotionData($id);

    /**
     * get the offer promotion by id
     * @param $id
     * @return $offerpromotion
     */
    public function deleteOfferPromotion($id);

    /**
     * get the offer promotion by request id
     * @param $request
     * @return $offerpromotion
     */
    public function offerPromotionStatusChange($request);
}
