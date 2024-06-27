<?php

namespace App\Repositories;

use App\Interfaces\Repositories\StoreRepositoryInterface;
use App\Models\Store;

class StoreRepository implements StoreRepositoryInterface
{
    public function getAllStoreList($request)
    {
        $keyword = $request->search;
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? "all" : $request->status;

        $store = Store::query()->latest('id');

        $store->when(request('search'), function ($query) {
            $query->where('addresses', 'LIKE', '%' . request('search') . '%')
                ->orWhere('name_en', 'LIKE', '%' . request('search') . '%')
                ->orWhere('name_hant', 'LIKE', '%' . request('search') . '%')
                ->orWhere('name_hans', 'LIKE', '%' . request('search') . '%')
                ->orWhere('email', 'LIKE', '%' . request('search') . '%')
                ->orWhere('phone', 'LIKE', '%' . request('search') . '%');
        });

        if ($status != 'all') {
            $store->where('status', $status);
        }

        $store = $store->with('updateUser')->paginate($perPage);
        $data  = [
            'keyword' => $keyword,
            'perPage' => $perPage,
            'status'  => $status,
            'store'   => $store,
        ];

        return $data;
    }

    public function saveStoreData($request, $id = null)
    {
        $requestData = $request->all();
        $addresses   = [
            'en'   => $requestData['addresses_en'],
            'hant' => $requestData['addresses_hant'],
            'hans' => $requestData['addresses_hans'],
        ];

        $requestData['addresses'] = $addresses;

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $store                     = Store::findOrFail($id);
            $store->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $store                       = Store::create($requestData);
        }

        return $store;
    }

    public function getStoreData($id)
    {
        return Store::findOrFail($id);
    }

    public function deleteStore($id)
    {
        return Store::destroy($id);
    }

    public function storeStatusChange($request)
    {
        $store = Store::findOrFail($request->id);
        $store->update(['status' => !$store->status]);

        return $store;
    }
}
