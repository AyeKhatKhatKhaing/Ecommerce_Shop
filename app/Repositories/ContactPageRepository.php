<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ContactPageRepositoryInterface;
use App\Models\ContactPage;

class ContactPageRepository implements ContactPageRepositoryInterface
{
    public function getContactPageIndex()
    {
        return ContactPage::first();
    }

    public function saveContactPageData($request)
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

        $contactpage = ContactPage::first();

        if ($contactpage) {
            $requestData['updated_by'] = auth()->user()->id;
            $contactpage->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $contactpage                 = ContactPage::create($requestData);
        }

        return true;
    }

    public function getContactPageData($id)
    {
        return ContactPage::findOrFail($id);
    }
}
