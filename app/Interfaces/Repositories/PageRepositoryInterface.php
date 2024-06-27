<?php

namespace App\Interfaces\Repositories;

interface PageRepositoryInterface
{
    /**
     * get the page list
     * @param $request
     * @return $page
     */
    public function getAllPageList($request);

    /**
     * get create page
     */
    public function createPage();

    /**
     * get the request data
     * @param $request, $id
     * @return $page
     */
    public function savePageData($request, $id);

    /**
     * get the page by id
     * @param $id
     * @return $page
     */
    public function getPageData($id);

    /**
     * get the page by id
     * @param $id
     * @return $page
     */
    public function deletePage($id);

    /**
     * get the page by request id
     * @param $request
     * @return $page
     */
    public function pageStatusChange($request);
}
