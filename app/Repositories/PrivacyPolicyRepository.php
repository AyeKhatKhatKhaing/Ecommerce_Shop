<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PrivacyPolicyRepositoryInterface;
use App\Models\PrivacyPolicy;

class PrivacyPolicyRepository implements PrivacyPolicyRepositoryInterface
{
    public function getPrivacyPolicyIndex()
    {
        return PrivacyPolicy::first();
    }

    public function getPrivacyPolicyData($id)
    {
        return PrivacyPolicy::findOrFail($id);
    }

    public function savePrivacyPolicyData($request)
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

        $privacypolicy = PrivacyPolicy::first();
        if ($privacypolicy) {
            $privacypolicy->update($requestData);
        } else {
            PrivacyPolicy::create($requestData);
        }

        return true;
    }
}
