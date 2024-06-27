<?php

namespace App\Interfaces\Repositories;

interface MemberExclusiveOfferRepositoryInterface
{
    /**
     * @return $memberexclusiveoffer and go to edit page
     */
    public function getMemberExclusiveOfferIndex();

    /**
     * get the Member Exclusive Offer page by id
     * @param $id
     * @return $memberexclusiveoffer
     */
    public function getMemberExclusiveOfferData($id);

    /**
     * save and update the Member Exclusive Offer Page
     * @param $request
     * @return $memberexclusiveoffer
     */
    public function saveMemberExclusiveOfferData($request);

}
