<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CommonProblemRepositoryInterface;
use App\Models\CommonProblem;

class CommonProblemRepository implements CommonProblemRepositoryInterface
{
    public function getCommonProblemIndex()
    {
        return CommonProblem::first();
    }

    public function saveCommonProblemData($request)
    {
        $requestData = $request->all();
        $meta_titles = [
            'en'   => $requestData['meta_title_en'],
            'hant' => $requestData['meta_title_hant'],
            'hans' => $requestData['meta_title_hans'],
        ];
        $meta_descriptions = [
            'en'   => $requestData['meta_description_en'],
            'hant' => $requestData['meta_description_hant'],
            'hans' => $requestData['meta_description_hans'],
        ];
        $requestData['meta_titles']       = $meta_titles;
        $requestData['meta_descriptions'] = $meta_descriptions;

        $commonproblem = CommonProblem::first();
        if ($commonproblem) {
            $commonproblem->update($requestData);
        } else {
            CommonProblem::create($requestData);
        }

        return true;
    }

    public function getCommonProblemData($id)
    {
        return CommonProblem::findOrFail($id);
    }
}
