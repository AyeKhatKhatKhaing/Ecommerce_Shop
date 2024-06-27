<?php

namespace App\Interfaces\Repositories;

interface RegionRepositoryInterface
{
    /**
     * get the region list
     * @param $request
     * @return $data[]
     */
    public function getAllRegionList($request);

    /**
     * get the region create page
     * @return $country
     */
    public function getRegionCreatePage();

    /**
     * get the request data
     * @param $request, $id
     * @return $region
     */
    public function saveRegionData($request, $id);

    /**
     * get the region by id
     * @param $id
     * @return $region
     */
    public function getRegionData($id);

    /**
     * get the region by id
     * @param $id
     * @return $region
     */
    public function deleteRegion($id);

    /**
     * get the region by request id
     * @param $request
     * @return $region
     */
    public function regionStatusChange($request);
}
