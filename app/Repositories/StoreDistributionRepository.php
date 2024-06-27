<?php

namespace App\Repositories;

use App\Interfaces\Repositories\StoreDistributionRepositoryInterface;
use App\Models\StoreDistribution;

class StoreDistributionRepository implements StoreDistributionRepositoryInterface
{
    public function getStoreDistributionIndex()
    {
        return StoreDistribution::first();
    }

    public function getStoreDistributionData($id)
    {
        return StoreDistribution::findOrFail($id);
    }

    public function saveStoreDistributionData($request)
    {
        $requestData   = $request->all();
        $banner_titles = [
            'en'   => $requestData['banner_title_en'],
            'hant' => $requestData['banner_title_hant'],
            'hans' => $requestData['banner_title_hans'],
        ];
        $titles = [
            'en'   => $requestData['title_en'],
            'hant' => $requestData['title_hant'],
            'hans' => $requestData['title_hans'],
        ];
        $descriptions = [
            'en'   => $requestData['description_en'],
            'hant' => $requestData['description_hant'],
            'hans' => $requestData['description_hans'],
        ];
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
        $requestData['banner_titles']     = $banner_titles;
        $requestData['titles']            = $titles;
        $requestData['descriptions']      = $descriptions;
        $requestData['meta_titles']       = $meta_titles;
        $requestData['meta_descriptions'] = $meta_descriptions;

        $storedistribution = StoreDistribution::first();
        if ($storedistribution) {
            $storedistribution->update($requestData);
        } else {
            StoreDistribution::create($requestData);
        }

        return true;
    }
}
