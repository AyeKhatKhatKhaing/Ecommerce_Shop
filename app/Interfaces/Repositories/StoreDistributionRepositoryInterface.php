<?php

namespace App\Interfaces\Repositories;

interface StoreDistributionRepositoryInterface
{
    /**
     * @return $storedistribution and go to edit page
     */
    public function getStoreDistributionIndex();

    /**
     * get the Store Distribution page by id
     * @param $id
     * @return $storedistribution
     */
    public function getStoreDistributionData($id);

    /**
     * save and update the Store Distribution Page
     * @param $request
     * @return $storedistribution
     */
    public function saveStoreDistributionData($request);
}
