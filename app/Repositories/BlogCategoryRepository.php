<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BlogCategoryRepositoryInterface;
use App\Models\BlogCategory;

class BlogCategoryRepository implements BlogCategoryRepositoryInterface
{
    public function getAllCategoryList($request)
    {
        $keyword = $request->get('search');
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? "all" : $request->status;

        $blogcategory = Blogcategory::where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('names', 'LIKE', "%$keyword%");
            }

            if ($status != "all") {
                $query->where('status', $status);
            }
        });

        $blogcategory = $blogcategory->with('updateUser')->latest('id')->paginate($perPage);

        $data = [
            'keyword'      => $keyword,
            'status'       => $status,
            'perPage'      => $perPage,
            'blogcategory' => $blogcategory,
        ];

        return $data;
    }

    public function saveCategoryData($request, $id = null)
    {
        $requestData = $request->all();

        $names = [
            'en'   => $requestData['name_en'],
            'hant' => $requestData['name_hant'],
            'hans' => $requestData['name_hans'],
        ];

        $requestData['names'] = $names;

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $blogcategory              = BlogCategory::findOrFail($id);
            $blogcategory->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $blogcategory                = BlogCategory::create($requestData);
        }

        return $blogcategory;
    }

    public function getCategoryData($id)
    {
        return BlogCategory::findOrFail($id);
    }

    public function deleteCategory($id)
    {
        return BlogCategory::destroy($id);
    }

    public function categoryStatusChange($request)
    {
        $blogcategory      = BlogCategory::findOrFail($request->id);
        $blogcategory->update(['status' => !$blogcategory->status]);

        return $blogcategory;
    }
}
