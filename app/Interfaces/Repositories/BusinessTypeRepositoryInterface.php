<?php

namespace App\Interfaces\Repositories;

interface BusinessTypeRepositoryInterface
{
    /**
     * get the Business Type list
     * @param $request
     * @return $data[]
     */
    public function getAllBusinessTypeList($request);

    /**
     * get the request data
     * @param $request, $id
     * @return $businesstype
     */
    public function saveBusinessTypeData($request, $id);

    /**
     * get the businesstype by id
     * @param $id
     * @return $businesstype
     */
    public function getBusinessTypeData($id);

    /**
     * get the businesstype by id
     * @param $id
     * @return $businesstype
     */
    public function deleteBusinessType($id);

    /**
     * get the businesstype by request id
     * @param $request
     * @return $businesstype
     */
    public function businessTypeStatusChange($request);
}
