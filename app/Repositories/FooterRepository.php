<?php

namespace App\Repositories;

use App\Interfaces\Repositories\FooterRepositoryInterface;
use App\Models\Footer;

class FooterRepository implements FooterRepositoryInterface
{
    public function getFooterIndex()
    {
        return Footer::first();
    }

    public function getFooterData($id)
    {
        return Footer::findOrFail($id);
    }

    public function saveFooterData($request)
    {
        $requestData = $request->all();

        $web_contents = [
            'en'   => $requestData['web_content_en'],
            'hant' => $requestData['web_content_hant'],
            'hans' => $requestData['web_content_hans'],
        ];

        $mobile_contents = [
            'en'   => $requestData['mobile_content_en'],
            'hant' => $requestData['mobile_content_hant'],
            'hans' => $requestData['mobile_content_hans'],
        ];

        $requestData['web_contents']    = $web_contents;
        $requestData['mobile_contents'] = $mobile_contents;

        $footer = Footer::first();

        if ($footer) {
            $footer->update($requestData);
        } else {
            Footer::create($requestData);
        }

        return true;
    }
}
