<?php

namespace App\Interfaces\Repositories;

interface MemberRepositoryInterface
{
    /**
     * get the member list
     * @param $request
     * @return $member
     */
    public function getAllMemberList($request);

    /**
     * get the member create page
     * @return $member_types, $countries, $business_types
     */
    public function createMemberPage();

    /**
     * get the request data
     * @param $request, $id
     * @return $member
     */
    public function saveMemberData($request, $id);

    /**
     * get the member by id
     * @param $id
     * @return $member
     */
    public function getMemberData($id);

    /**
     * get the member by id
     * @param $id
     * @return $member
     */
    public function deleteMember($id);

    /**
     * get the member by request id
     * @param $request
     * @return $member
     */
    public function memberStatusChange($request);
}
