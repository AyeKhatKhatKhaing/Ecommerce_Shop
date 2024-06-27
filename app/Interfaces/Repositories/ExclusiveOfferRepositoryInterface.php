<?php

namespace App\Interfaces\Repositories;

interface ExclusiveOfferRepositoryInterface
{
    /**
     * get the Exclusive offer list
     * @param $request
     * @return $data[]
     */
    public function getAllExclusiveOfferList($request);

    /**
     * get the request data
     * @param $request, $id
     * @return $exclusiveoffer
     */
    public function saveExclusiveOfferData($request, $id);

    /**
     * get the exclusiveoffer by id
     * @param $id
     * @return $exclusiveoffer
     */
    public function getExclusiveOfferData($id);

    /**
     * get the exclusiveoffer by id
     * @param $id
     * @return $exclusiveoffer
     */
    public function deleteExclusiveOffer($id);

    /**
     * get the exclusiveoffer by request id
     * @param $request
     * @return $exclusiveoffer
     */
    public function exclusiveOfferStatusChange($request);
}
