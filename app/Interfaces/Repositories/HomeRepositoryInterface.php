<?php

namespace App\Interfaces\Repositories;

interface HomeRepositoryInterface
{
    /**
     * @return $homepage and go to edit page
     */
    public function getHomePageIndex();

    /**
     * save and update the Home Page
     * @param $request
     * @return $homepage
     */
    public function saveHomePageData($request);

    /**
     * get the home page by id
     * @param $id
     * @return $homepage
     */
    public function getHomePageData($id);
}
