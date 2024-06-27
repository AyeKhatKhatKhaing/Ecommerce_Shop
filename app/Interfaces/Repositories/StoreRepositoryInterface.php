<?php

namespace App\Interfaces\Repositories;

interface StoreRepositoryInterface
{
    /**
     * get the store list
     * @param $request
     * @return $data[]
     */
    public function getAllStoreList($request);

    /**
     * get the request data
     * @param $request, $id
     * @return $store
     */
    public function saveStoreData($request, $id);

    /**
     * get the store by id
     * @param $id
     * @return $store
     */
    public function getStoreData($id);

    /**
     * get the store by id
     * @param $id
     * @return $store
     */
    public function deleteStore($id);

    /**
     * get the store by request id
     * @param $request
     * @return $store
     */
    public function storeStatusChange($request);
}
