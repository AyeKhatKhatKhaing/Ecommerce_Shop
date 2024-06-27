<?php

namespace App\Interfaces\Repositories;

interface FooterRepositoryInterface
{
    /**
     * @return $footer and go to edit page
     */
    public function getFooterIndex();

    /**
     * get the Footer page by id
     * @param $id
     * @return $footer
     */
    public function getFooterData($id);

    /**
     * save and update the Footer Page
     * @param $request
     * @return $footer
     */
    public function saveFooterData($request);
}
