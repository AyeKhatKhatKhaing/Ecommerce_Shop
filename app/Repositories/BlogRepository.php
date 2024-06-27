<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BlogRepositoryInterface;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Traits\AdminRolePermission;
use Str;

class BlogRepository implements BlogRepositoryInterface 
{
    use AdminRolePermission;

    public function getAllBlogList($request) 
    {           
        $keyword = $request->get('search');
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? "all" : $request->status;

        $blog = Blog::where(function ($query) use ($keyword, $status) {
            if ($query) {
                $query->where('titles', 'LIKE', "%$keyword%");
            }

            if ($status != "all") {
                $query->where('status', $status);
            }
        });

        $blog = $blog->with('updateUser')->latest('id')->paginate($perPage);

        $data = [
            'blog'    => $blog,
            'keyword' => $keyword,
            'status'  => $status,
            'perPage' => $perPage,
        ];

        return $data;
    }

    public function createBlogPage()
    {
        return BlogCategory::active()->get();
    }

    public function saveBlogData($request, $id = null)
    {
        $requestData = $request->all();

        $titles = [
            'en'   => $requestData['title_en'],
            'hant' => $requestData['title_hant'],
            'hans' => $requestData['title_hans'],
        ];

        $short_descriptions = [
            'en'   => $requestData['short_description_en'],
            'hant' => $requestData['short_description_hant'],
            'hans' => $requestData['short_description_hans'],
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

        $requestData['titles']             = $titles;
        $requestData['short_descriptions'] = $short_descriptions;
        $requestData['descriptions']       = $descriptions;
        $requestData['meta_titles']        = $meta_titles;
        $requestData['meta_descriptions']  = $meta_descriptions;
        $requestData['slug']               = Str::slug($requestData['title_en']);

        if ($id) {
            $requestData['updated_by'] = auth()->user()->id;
            $blog                      = Blog::findOrFail($id);
            $blog->update($requestData);
        } else {    
            $request->merge(['created_date' => now(), 'created_by' => auth()->user()->id]);
            $requestData['created_date'] = now();
            $requestData['created_by']   = auth()->user()->id;
            $blog                        = Blog::create($requestData);
        }

        return $blog;
    }

    public function getBlogData($id)
    {
        $blogcategory = BlogCategory::active()->get();
        $blog         = Blog::findOrFail($id);

        $data = [
            'blogcategory' => $blogcategory,
            'blog'         => $blog,
        ];

        return $data;
    }

    public function deleteBlog($id)
    {
        return Blog::destroy($id);
    }   

    public function blogStatusChange($request)
    {
        $blog = Blog::findOrFail($request->id);
        $blog->update(['status' => !$blog->status]);

        return $blog;
    }
}