<?php

namespace App\Interfaces\Repositories;

interface CountryRepositoryInterface
{
    /**
     * get the country list
     * @param $request
     * @return $data[]
     */
    public function getAllCountryList($request);

    /**
     * get the request data
     * @param $request, $id
     * @return $country
     */
    public function saveCountryData($request, $id);

    /**
     * get the country by id
     * @param $id
     * @return $country
     */
    public function getCountryData($id);

    /**
     * get the country by id
     * @param $id
     * @return $country
     */
    public function deleteCountry($id);

    /**
     * get the country by request id
     * @param $request
     * @return $country
     */
    public function countryStatusChange($request);
}
