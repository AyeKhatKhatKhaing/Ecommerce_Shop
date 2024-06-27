<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AttributeRequest;
use App\Models\AttributeTerm;
use App\Traits\AdminRolePermission;
use App\Services\Admin\ProductAttributeService;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    use AdminRolePermission;

    protected $productAttributeService;

    public function __construct(ProductAttributeService $service)
    {
        $this->productAttributeService = $service;
    }

    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $keyword = $request->search;
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? 'all' : $request->status;

        $attribute_terms = AttributeTerm::with(['updateUser', 'attributes'])->where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('name_en', 'like', "%$keyword%")
                    ->orWhere('name_hans', 'like', '%keyword%')
                    ->orWhere('name_hant', 'like', '%keyword%');
            }

            if ($status != 'all') {
                $query->where('status', $status);
            }
        })->latest('id')->paginate($perPage);

        return view('admin.attribute.index', compact('attribute_terms', 'keyword', 'status'));
    }

    public function create()
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $attribute_terms = AttributeTerm::where('status', 1)->pluck('name_en', 'id');
        return view('admin.attribute.create', compact('attribute_terms'));
    }


    public function store(AttributeRequest $request)
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $attribute_term = $this->productAttributeService->addAttributeTerm($request);
        $this->productAttributeService->addAttributeValue($attribute_term, $request);

        return redirect('admin/product-attribute')->with('flash_message', 'Attribute added!');
    }


    public function edit($id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $attribute_term = AttributeTerm::findOrFail($id);

        return view('admin.attribute.edit', compact('attribute_term'));
    }


    public function update(AttributeRequest $request, $id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $attribute_term = AttributeTerm::with('attributes')->findOrFail($id);

        $this->productAttributeService->updateAttributeValue($attribute_term, $request);

        return redirect('admin/product-attribute')->with('flash_message', 'Attribute updated!');
    }


    public function destroy($id)
    {
        if($this->adminHasPermission('can_access_delete')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        AttributeTerm::destroy($id);

        return back()->with('flash_message', 'Attribute term deleted!');
    }
    

    public function statusChange(Request $request)
    {
        $term = AttributeTerm::findOrFail($request->id);
        $term->update(['status' => !$term->status]);

        return response()->json([
            'success'   => true,
            'isPublish' => $term->status,
            'id'        => $term->id,
        ]);
    }
}
