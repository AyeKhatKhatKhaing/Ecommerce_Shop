<?php

namespace App\Interfaces\Repositories;

interface BlogCategoryRepositoryInterface
{
    /**
     * get the category list
     * @param $request
     * @return $category
     */
    public function getAllCategoryList($request);

    /**
	 * get the request data
	 * @param $request, $id
	 * @return $category
	 */
    public function saveCategoryData($request, $id);

    /**
	 * get the category by id
	 * @param $id
	 * @return $category
	 */
    public function getCategoryData($id);

    /**
	 * get the category by id
	 * @param $id
	 * @return $category
	 */
    public function deleteCategory($id);

    /**
	 * get the category by request id
	 * @param $request
	 * @return $category
	 */
    public function categoryStatusChange($request);
}