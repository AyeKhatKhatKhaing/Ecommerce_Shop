<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ProductLabelRepositoryInterface;
use App\Models\ProductLabel;

class ProductLabelRepository implements ProductLabelRepositoryInterface
{
    public function getAllProductLabelList($request)
    {
        $keyword = $request->get('search');
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? "all" : $request->status;

        $productlabel = ProductLabel::with('updateUser')->where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('name_hant', 'LIKE', "%$keyword%");
            }

            if ($status != "all") {
                $query->where('status', $status);
            }
        })->latest('id')->paginate($perPage);

        $data = [
            'keyword'      => $keyword,
            'perPage'      => $perPage,
            'status'       => $status,
            'productlabel' => $productlabel,
        ];

        return $data;
    }

    public function saveProductLabelData($request, $id = null)
    {
        $requestData = $request->all();

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $product_label             = ProductLabel::findOrFail($id);
            $product_label->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $product_label               = ProductLabel::create($requestData);
        }

        return $product_label;
    }

    public function getProductLabelData($id)
    {
        return ProductLabel::findOrFail($id);
    }

    public function deleteProductLabel($id)
    {
        return ProductLabel::destroy($id);
    }

    public function productLabelStatusChange($request)
    {
        $productlabel = ProductLabel::findOrFail($request->id);
        $productlabel->update(['status' => !$productlabel->status]);

        return $productlabel;
    }
}
