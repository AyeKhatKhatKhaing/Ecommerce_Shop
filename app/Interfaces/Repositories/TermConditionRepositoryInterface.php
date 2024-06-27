<?php

namespace App\Interfaces\Repositories;

interface TermConditionRepositoryInterface
{
    /**
     * @return $termcondition and go to edit page
     */
    public function getTermConditionIndex();

    /**
     * get the Term Condition page by id
     * @param $id
     * @return $termcondition
     */
    public function getTermConditionData($id);

    /**
     * save and update the Term Condition Page
     * @param $request
     * @return $termcondition
     */
    public function saveTermConditionData($request);
}
