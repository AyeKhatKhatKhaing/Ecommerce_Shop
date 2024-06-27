<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CountryRepositoryInterface;
use App\Models\Country;

class CountryRepository implements CountryRepositoryInterface
{
    public function getAllCountryList($request)
    {
        $keyword = $request->search;
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? 'all' : $request->status;

        $countries = Country::with('updateUser')->where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('name_en', 'like', "%$keyword%")
                    ->orWhere('name_hans', 'like', '%keyword%')
                    ->orWhere('name_hant', 'like', '%keyword%');
            }

            if ($status != 'all') {
                $query->where('status', $status);
            }
        })->latest('id')->paginate($perPage);

        $data = [
            'keyword'   => $keyword,
            'perPage'   => $perPage,
            'status'    => $status,
            'countries' => $countries,
        ];

        return $data;
    }

    public function saveCountryData($request, $id = null)
    {
        $requestData = $request->all();

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $country                   = Country::findOrFail($id);
            $country->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $country                     = Country::create($requestData);
        }

        return $country;
    }

    public function getCountryData($id)
    {
        return Country::findOrFail($id);
    }

    public function deleteCountry($id)
    {
        return Country::destroy($id);
    }

    public function countryStatusChange($request)
    {
        $country = Country::findOrFail($request->id);
        $country->update(['status' => !$country->status]);

        return $country;
    }
}
