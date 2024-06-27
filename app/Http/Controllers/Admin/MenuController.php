<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataArrayHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuFormRequest;
use App\Models\Menu;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    use AdminRolePermission;

    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $keyword = $request->get('search');
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? "all" : $request->status;

        $query = Menu::query()->with('updateUser')->orderBy('sort', 'asc');

        $menu = $query->where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('name_en', 'LIKE', "%$keyword%")
                    ->orWhere('name_hant', 'LIKE', "%$keyword%")
                    ->orWhere('name_hans', 'LIKE', "%$keyword%")
                    ->orWhereHas('category', function ($que) use ($keyword) {
                        $que->where('name_en', 'LIKE', "%$keyword%")
                            ->where('name_hant', 'LIKE', "%$keyword%")
                            ->where('name_hans', 'LIKE', "%$keyword%");
                    });
            }
            if ($status != "all") {
                $query->where('status', $status);
            }
        })->paginate($perPage);

        return view('admin.menu.index', compact('menu', 'keyword', 'status', 'perPage'));
    }

    public function create()
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $categories = DataArrayHelper::getCategories();
        $countries  = DataArrayHelper::getCountries();
        $promotions = DataArrayHelper::getPromotions();

        return view('admin.menu.create', compact('categories', 'countries', 'promotions'));
    }

    public function store(MenuFormRequest $request)
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $request->merge(['created_date' => now(), 'created_by' => auth()->user()->id]);

        $requestData                 = $request->all();
        $requestData['show_submenu'] = $request->show_submenu == 'on' ? 1 : 0;

        Menu::create($requestData);

        return redirect('admin/menu')->with('flash_message', 'Menu added!');
    }

    public function edit($id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $categories = DataArrayHelper::getCategories();
        $countries  = DataArrayHelper::getCountries();
        $promotions = DataArrayHelper::getPromotions();
        $menu       = Menu::findOrFail($id);

        return view('admin.menu.edit', compact('menu', 'categories', 'countries', 'promotions'));
    }

    public function update(MenuFormRequest $request, $id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $request->merge(['updated_by' => auth()->user()->id]);

        $requestData                 = $request->all();
        $requestData['show_submenu'] = $request->show_submenu == 'on' ? 1 : 0;

        $menu = Menu::findOrFail($id);
        $menu->update($requestData);

        return redirect('admin/menu')->with('flash_message', 'Menu updated!');
    }

    public function destroy($id)
    {
        if($this->adminHasPermission('can_access_delete')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        Menu::destroy($id);

        return redirect('admin/menu')->with('flash_message', 'Menu deleted!');
    }

    public function statusChange(Request $request)
    {
        $menu = Menu::findOrFail($request->id);
        $menu->update(['status' => !$menu->status]);

        return response()->json([
            "success"   => true,
            'isPublish' => $menu->status,
            'id'        => $menu->id,
        ]);
    }
}
