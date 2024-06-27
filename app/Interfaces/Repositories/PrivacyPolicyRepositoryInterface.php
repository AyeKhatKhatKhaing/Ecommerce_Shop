<?php

namespace App\Interfaces\Repositories;

interface PrivacyPolicyRepositoryInterface
{
    /**
     * @return $privacypolicy and go to edit page
     */
    public function getPrivacyPolicyIndex();

    /**
     * get the Privacy Policy page by id
     * @param $id
     * @return $privacypolicy
     */
    public function getPrivacyPolicyData($id);

    /**
     * save and update the Privacy Policy Page
     * @param $request
     * @return $privacypolicy
     */
    public function savePrivacyPolicyData($request);
}
