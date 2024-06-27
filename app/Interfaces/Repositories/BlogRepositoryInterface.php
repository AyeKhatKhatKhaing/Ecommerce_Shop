<?php

namespace App\Interfaces\Repositories;

interface BlogRepositoryInterface
{
    /**
     * get the blog list
     * @param $request
     * @return $blog
     */
    public function getAllBlogList($request);

    /**
     * get blog create page
     */
    public function createBlogPage();

    /**
	 * get the request data
	 * @param $request, $id
	 * @return $blog
	 */
    public function saveBlogData($request, $id);

    /**
	 * get the blog by id
	 * @param $id
	 * @return $blog
	 */
    public function getBlogData($id);

    /**
	 * get the blog by id
	 * @param $id
	 * @return $blog
	 */
    public function deleteBlog($id);

    /**
	 * get the blog by request id
	 * @param $request
	 * @return $blog
	 */
    public function blogStatusChange($request);
}
