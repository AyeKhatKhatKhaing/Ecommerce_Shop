<?php

namespace App\Interfaces\Repositories;

interface AboutRemflyRepositoryInterface
{
    /**
     * @return $about remfly and go to edit page
     */
    public function getAboutRemflyIndex();

    /**
     * save and update the About Remfly Page
     * @param $request
     * @return $aboutremfly
     */
    public function saveAboutRemflyData($request);

    /**
     * get the about remfly page by id
     * @param $id
     * @return $aboutremfly
     */
    public function getAboutRemflyData($id);
}
