<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ProductCategoryRepositoryInterface;
use App\Models\Category;

class ProductCategoryRepository implements ProductCategoryRepositoryInterface
{
    public function getAllCategoryList($request)
    {
        $keyword = $request->search;
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? "all" : $request->status;

        $category = Category::with('parent_category', 'updateUser')->where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('name_hant', 'like', "%$keyword%");
            }

            if ($status != 'all') {
                $query->where('status', $status);
            }
        })->orderBy('sort', 'asc')->paginate($perPage);

        $data = [
            'keyword'  => $keyword,
            'status'   => $status,
            'perPage'  => $perPage,
            'category' => $category,
        ];

        return $data;
    }

    public function saveCategoryData($request, $id = null)
    {
        $requestData             = $request->all();
        $requestData['is_other'] = $request->is_other == 'on' ? 1 : 0;

        if ($id) {
            $requestData['updated_by']   = auth()->user()->id;
            $category                    = Category::findOrFail($id);
            $category->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $category                    = Category::create($requestData);
        }

        return $category;
    }

    public function getCategoryData($id)
    {
        return Category::findOrFail($id);
    }

    public function deleteCategory($id)
    {
        return Category::destroy($id);
    }

    public function categoryStatusChange($request)
    {
        $category = Category::findOrFail($request->id);
        $category->update(['status' => !$category->status]);

        return $category;
    }
}
