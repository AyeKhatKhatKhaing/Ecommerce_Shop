<?php

namespace App\Repositories;

use App\Interfaces\Repositories\RegionRepositoryInterface;
use App\Models\Country;
use App\Models\Region;

class RegionRepository implements RegionRepositoryInterface
{
    public function getAllRegionList($request)
    {
        $keyword = $request->search;
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? 'all' : $request->status;

        $regions = Region::with(['updateUser', 'country'])->where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->whereIn('country_id', $query->SearchByCountryName($keyword))
                    ->orWhere('name_en', 'like', "%$keyword%")
                    ->orWhere('name_hans', 'like', '%keyword%')
                    ->orWhere('name_hant', 'like', '%keyword%');
            }

            if ($status != 'all') {
                $query->where('status', $status);
            }
        })->latest('id')->paginate($perPage);

        $data = [
            'keyword' => $keyword,
            'perPage' => $perPage,
            'status'  => $status,
            'regions' => $regions,
        ];

        return $data;
    }

    public function getRegionCreatePage()
    {
        return Country::where('status', 1)->pluck('name_hant', 'id');
    }

    public function saveRegionData($request, $id = null)
    {
        $requestData = $request->all();

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $region                    = Region::findOrFail($id);
            $region->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $region                      = Region::create($requestData);
        }

        return $region;
    }

    public function getRegionData($id)
    {
        $region    = Region::findOrFail($id);
        $countries = Country::where('status', 1)->pluck('name_hant', 'id');

        $data = [
            'region'    => $region,
            'countries' => $countries,
        ];

        return $data;
    }

    public function deleteRegion($id)
    {
        return Region::destroy($id);
    }

    public function regionStatusChange($request)
    {
        $region = Region::findOrFail($request->id);
        $region->update(['status' => !$region->status]);

        return $region;
    }
}
