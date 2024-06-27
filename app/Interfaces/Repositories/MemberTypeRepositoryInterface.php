<?php

namespace App\Interfaces\Repositories;

interface MemberTypeRepositoryInterface
{
    /**
     * get the membertype list
     * @param $request
     * @return $membertype
     */
    public function getAllMemberTypeList($request);

    /**
     * get the request data
     * @param $request, $id
     * @return $membertype
     */
    public function saveMemberTypeData($request, $id);

    /**
     * get the membertype by id
     * @param $id
     * @return $member
     */
    public function getMemberTypeData($id);

    /**
     * get the membertype by id
     * @param $id
     * @return $membertype
     */
    public function deleteMemberType($id);

    /**
     * get the membertype by request id
     * @param $request
     * @return $membertype
     */
    public function memberTypeStatusChange($request);
}
