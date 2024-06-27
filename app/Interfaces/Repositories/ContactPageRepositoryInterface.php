<?php

namespace App\Interfaces\Repositories;

interface ContactPageRepositoryInterface
{
    /**
     * @return $contactpage and go to edit page
     */
    public function getContactPageIndex();

    /**
     * save and update the contact Page
     * @param $request
     * @return $contactpage
     */
    public function saveContactPageData($request);

    /**
     * get the contct page by id
     * @param $id
     * @return $contactpage
     */
    public function getContactPageData($id);
}
