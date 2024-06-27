<?php

namespace App\Repositories;

use App\Interfaces\Repositories\TermConditionRepositoryInterface;
use App\Models\TermCondition;

class TermConditionRepository implements TermConditionRepositoryInterface
{
    public function getTermConditionIndex()
    {
        return TermCondition::first();
    }

    public function getTermConditionData($id)
    {
        return TermCondition::findOrFail($id);
    }

    public function saveTermConditionData($request)
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

        $termcondition = TermCondition::first();
        if ($termcondition) {
            $termcondition->update($requestData);
        } else {
            TermCondition::create($requestData);
        }

        return true;
    }
}
