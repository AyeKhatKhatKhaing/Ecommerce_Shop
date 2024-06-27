<?php

namespace App\Interfaces\Repositories;

interface PromotionRepositoryInterface
{
    /**
     * get the promotion list
     * @param $request
     * @return $data[]
     */
    public function getAllPromotionList($request);

    /**
     * get the request data
     * @param $request, $id
     * @return $promotion
     */
    public function savePromotionData($request, $id);

    /**
     * get the promotion by id
     * @param $id
     * @return $promotion
     */
    public function getPromotionData($id);

    /**
     * get the promotion by id
     * @param $id
     * @return $promotion
     */
    public function deletePromotion($id);

    /**
     * get the promotion by request id
     * @param $request
     * @return $promotion
     */
    public function promotionStatusChange($request);
}
