<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PageRepositoryInterface;
use App\Models\Category;
use App\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    public function getAllPageList($request)
    {
        $keyword = $request->get('search');
        $perPage = $request->display ? $request->display : 10;

        $page = Page::where(function ($query) use ($keyword) {
            if ($keyword != null) {
                $query->where('titles', 'LIKE', "%$keyword%")
                    ->orWhere('descriptions', 'LIKE', "%$keyword%");
            }
        });

        $page = $page->with('updateUser')->latest('id')->paginate($perPage);

        $data = [
            'keyword' => $keyword,
            'page'    => $page,
        ];

        return $data;
    }

    public function createPage()
    {
        return Category::where('status', 1)->pluck('name_hant', 'id');
    }

    public function savePageData($request, $id = null)
    {
        $requestData = $request->all();

        $titles = [
            'en'   => $requestData['title_en'],
            'hant' => $requestData['title_hant'],
            'hans' => $requestData['title_hans'],
        ];
        $descriptions = [
            'en'   => $requestData['description_en'],
            'hant' => $requestData['description_hant'],
            'hans' => $requestData['description_hans'],
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
        $requestData['titles']            = $titles;
        $requestData['descriptions']      = $descriptions;
        $requestData['meta_titles']       = $meta_titles;
        $requestData['meta_descriptions'] = $meta_descriptions;

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $page                      = Page::findOrFail($id);
            $page->update($requestData);
        } else {
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $page                        = Page::create($requestData);
        }

        return $page;
    }

    public function getPageData($id)
    {
        $categories = Category::where('status', 1)->pluck('name_hant', 'id');
        $page       = Page::findOrFail($id);

        $data = [
            'categories' => $categories,
            'page'       => $page,
        ];

        return $data;
    }

    public function deletePage($id)
    {
        return Page::destroy($id);
    }

    public function pageStatusChange($request)
    {
        $page = Page::findOrFail($request->id);
        $page->update(['status' => !$page->status]);

        return $page;
    }
}
