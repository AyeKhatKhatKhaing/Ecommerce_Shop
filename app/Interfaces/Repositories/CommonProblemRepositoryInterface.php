<?php

namespace App\Interfaces\Repositories;

interface CommonProblemRepositoryInterface
{
    /**
     * @return $common problem and go to edit page
     */
    public function getCommonProblemIndex();

    /**
     * save and update the common problem Page
     * @param $request
     * @return $commonproblem
     */
    public function saveCommonProblemData($request);

    /**
     * get the common problem page by id
     * @param $id
     * @return $commonproblem
     */
    public function getCommonProblemData($id);
}
