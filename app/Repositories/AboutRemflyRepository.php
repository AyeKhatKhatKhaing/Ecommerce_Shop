<?php

namespace App\Repositories;

use App\Interfaces\Repositories\AboutRemflyRepositoryInterface;
use App\Models\AboutRemfly;

class AboutRemflyRepository implements AboutRemflyRepositoryInterface
{
    public function getAboutRemflyIndex()
    {
        return AboutRemfly::first();
    }

    public function saveAboutRemflyData($request)
    {
        $requestData = $request->all();

        $banner_titles = [
            'en'   => $requestData['banner_title_en'],
            'hant' => $requestData['banner_title_hant'],
            'hans' => $requestData['banner_title_hans'],
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
        $requestData['meta_titles']       = $meta_titles;
        $requestData['meta_descriptions'] = $meta_descriptions;

        $aboutremfly = AboutRemfly::first();
        
        if ($aboutremfly) {
            $aboutremfly->update($requestData);
        } else {
            AboutRemfly::create($requestData);
        }

        return true;
    }

    public function getAboutRemflyData($id)
    {
        return AboutRemfly::findOrFail($id);
    }
}
