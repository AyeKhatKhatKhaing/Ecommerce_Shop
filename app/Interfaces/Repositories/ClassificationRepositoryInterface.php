<?php

namespace App\Interfaces\Repositories;

interface ClassificationRepositoryInterface
{
    /**
     * get the classification list
     * @param $request
     * @return $data[]
     */
    public function getAllClassificationList($request);

    /**
     * get the request data
     * @param $request, $id
     * @return $classification
     */
    public function saveClassificationData($request, $id);

    /**
     * get the classification by id
     * @param $id
     * @return $classification
     */
    public function getClassificationData($id);

    /**
     * get the classification by id
     * @param $id
     * @return $classification
     */
    public function deleteClassification($id);

    /**
     * get the classification by request id
     * @param $request
     * @return $classification
     */
    public function classificationStatusChange($request);
}
