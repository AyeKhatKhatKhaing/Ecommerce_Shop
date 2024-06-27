<?php

namespace App\Repositories;

use App\Interfaces\Repositories\MemberExclusiveOfferRepositoryInterface;
use App\Models\MemberExclusiveOffer;

class MemberExclusiveOfferRepository implements MemberExclusiveOfferRepositoryInterface
{
    public function getMemberExclusiveOfferIndex()
    {
        return MemberExclusiveOffer::first();
    }

    public function getMemberExclusiveOfferData($id)
    {
        return MemberExclusiveOffer::findOrFail($id);
    }

    public function saveMemberExclusiveOfferData($request)
    {
        $requestData = $request->all();

        $banner_titles = [
            'en'   => $requestData['banner_title_en'],
            'hant' => $requestData['banner_title_hant'],
            'hans' => $requestData['banner_title_hans'],
        ];

        $notes = [
            'en'   => $requestData['note_en'],
            'hant' => $requestData['note_hant'],
            'hans' => $requestData['note_hans'],
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
        $requestData['notes']             = $notes;
        $requestData['meta_titles']       = $meta_titles;
        $requestData['meta_descriptions'] = $meta_descriptions;

        $memberexclusiveoffer = MemberExclusiveOffer::first();

        if ($memberexclusiveoffer) {
            $requestData['updated_by'] = auth()->user()->id;
            $memberexclusiveoffer->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;

            $memberexclusiveoffer = MemberExclusiveOffer::create($requestData);
        }

        return true;
    }
}
