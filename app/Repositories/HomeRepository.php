<?php

namespace App\Repositories;

use App\Helpers\AdminHelper;
use App\Interfaces\Repositories\HomeRepositoryInterface;
use App\Models\Home;

class HomeRepository implements HomeRepositoryInterface
{
    public function getHomePageIndex()
    {
        return Home::first();
    }

    public function saveHomePageData($request)
    {
        $requestData   = $request->all();
        $feature_names = [
            'en'   => $requestData['feature_name_en'],
            'hant' => $requestData['feature_name_hant'],
            'hans' => $requestData['feature_name_hans'],
        ];
        $feature_titles = [
            'en'   => $requestData['feature_title_en'],
            'hant' => $requestData['feature_title_hant'],
            'hans' => $requestData['feature_title_hans'],
        ];
        $feature_descriptions = [
            'en'   => $requestData['feature_description_en'],
            'hant' => $requestData['feature_description_hant'],
            'hans' => $requestData['feature_description_hans'],
        ];
        $penfold_names = [
            'en'   => $requestData['penfold_name_en'],
            'hant' => $requestData['penfold_name_hant'],
            'hans' => $requestData['penfold_name_hans'],
        ];
        $penfold_titles = [
            'en'   => $requestData['penfold_title_en'],
            'hant' => $requestData['penfold_title_hant'],
            'hans' => $requestData['penfold_title_hans'],
        ];
        $penfold_descriptions = [
            'en'   => $requestData['penfold_description_en'],
            'hant' => $requestData['penfold_description_hant'],
            'hans' => $requestData['penfold_description_hans'],
        ];
        $exclusive_titles = [
            'en'   => $requestData['exclusive_title_en'],
            'hant' => $requestData['exclusive_title_hant'],
            'hans' => $requestData['exclusive_title_hans'],
        ];
        $exclusive_descriptions = [
            'en'   => $requestData['exclusive_description_en'],
            'hant' => $requestData['exclusive_description_hant'],
            'hans' => $requestData['exclusive_description_hans'],
        ];
        $about_titles = [
            'en'   => $requestData['about_title_en'],
            'hant' => $requestData['about_title_hant'],
            'hans' => $requestData['about_title_hans'],
        ];
        $about_descriptions = [
            'en'   => $requestData['about_description_en'],
            'hant' => $requestData['about_description_hant'],
            'hans' => $requestData['about_description_hans'],
        ];
        $store_titles = [
            'en'   => $requestData['store_title_en'],
            'hant' => $requestData['store_title_hant'],
            'hans' => $requestData['store_title_hans'],
        ];
        $store_descriptions = [
            'en'   => $requestData['store_description_en'],
            'hant' => $requestData['store_description_hant'],
            'hans' => $requestData['store_description_hans'],
        ];
        $brand_logo = [];

        if ($requestData['brand_image'][0] != null) {
            for ($i = 0; $i < count($requestData['brand_indices']); $i++) {
                $single = [
                    "image"     => AdminHelper::storageFileExist($requestData['brand_image'][$i]),
                    "url"       => $requestData['brand_url'][$i],
                    "image_alt" => $requestData['brand_image_alt'] ? $requestData['brand_image_alt'][$i] : null,
                ];
                array_push($brand_logo, $single);
            }
        }
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

        $requestData['feature_names']          = $feature_names;
        $requestData['feature_titles']         = $feature_titles;
        $requestData['feature_descriptions']   = $feature_descriptions;
        $requestData['penfold_names']          = $penfold_names;
        $requestData['penfold_titles']         = $penfold_titles;
        $requestData['penfold_descriptions']   = $penfold_descriptions;
        $requestData['exclusive_titles']       = $exclusive_titles;
        $requestData['exclusive_descriptions'] = $exclusive_descriptions;
        $requestData['about_titles']           = $about_titles;
        $requestData['about_descriptions']     = $about_descriptions;
        $requestData['store_titles']           = $store_titles;
        $requestData['store_descriptions']     = $store_descriptions;
        $requestData['brand_logo']             = $brand_logo;
        $requestData['meta_titles']            = $meta_titles;
        $requestData['meta_descriptions']      = $meta_descriptions;

        $home = Home::first();
        if ($home) {
            $home->update($requestData);
        } else {
            Home::create($requestData);
        }

        return true;
    }

    public function getHomePageData($id)
    {
        return Home::findOrFail($id);
    }
}
