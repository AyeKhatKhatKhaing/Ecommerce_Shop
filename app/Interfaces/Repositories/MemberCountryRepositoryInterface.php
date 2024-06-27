<?php

namespace App\Interfaces\Repositories;

interface MemberCountryRepositoryInterface
{
    /**
     * get the Member Country list
     * @param $request
     * @return $data[]
     */
    public function getAllMemberCountryList($request);

    /**
     * get the request data
     * @param $request, $id
     * @return $member_country
     */
    public function saveMemberCountryData($request, $id);

    /**
     * get the member country by id
     * @param $id
     * @return $membercountry
     */
    public function getMemberCountryData($id);

    /**
     * get the member country by id
     * @param $id
     * @return $membercountry
     */
    public function deleteMemberCountry($id);

    /**
     * get the member country by request id
     * @param $request
     * @return $membercountry
     */
    public function memberCountryStatusChange($request);
}
