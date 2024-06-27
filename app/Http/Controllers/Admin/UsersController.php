<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserFormRequest;
use App\Models\Role;
use App\Models\User;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    use AdminRolePermission;

    public function __construct()
    {
        $this->middleware('role:admin');
    }
    
    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $keyword = $request->get('search');
        $perPage = $request->display ? $request->display : 10;

        $query   = User::with('roles')->where(function ($query) use ($keyword) {
                        if ($keyword) {
                            $query->whereHas('roles', function ($query) {
                                $query->where('name', 'like', '%' . request('search') . '%');
                            })
                            ->orWhere('name', 'LIKE', "%$keyword%");
                        }
                    });

        $users   = $query->with('roles')->latest()->paginate($perPage);

        return view('admin.users.index', compact('users', 'keyword', 'perPage'));
    }


    public function create()
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $roles  = Role::select('id', 'name', 'label')->get();
        $roles  = $roles->pluck('label', 'name');

        return view('admin.users.create', compact('roles'));
    }


    public function store(Request $request)
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->validate(
            $request,
            [
                'name'     => 'required',
                'email'    => 'required|string|max:255|email|unique:users',
                'password' => 'required|min:6',
                'roles'    => 'required',
            ]
        );

        $data             = $request->except('password');
        $data['password'] = bcrypt($request->password);
        $user             = User::create($data);

        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }

        return redirect('admin/users')->with('flash_message', 'User added!');
    }


    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $roles      = Role::select('id', 'name', 'label')->get();
        $roles      = $roles->pluck('label', 'name');

        $user       = User::with('roles')->select('id', 'name', 'email')->findOrFail($id);
        $user_roles = [];

        foreach ($user->roles as $role) {
            $user_roles[] = $role->name;
        }

        return view('admin.users.edit', compact('user', 'roles', 'user_roles'));
    }

    public function update(Request $request, $id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }
        
        $this->validate(
            $request,
            [
                'name'     => 'required',
                'email'    => 'required|string|max:255|email|unique:users,email,' . $id,
                'roles'    => 'required',
                'password' => 'required|min:6',
            ]
        );

        $data = $request->except('password');
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user = User::findOrFail($id);
        $user->update($data);

        $user->roles()->detach();
        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }

        return redirect('admin/users')->with('flash_message', 'User updated!');
    }

    public function destroy($id)
    {
        if($this->adminHasPermission('can_access_delete')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        User::destroy($id);

        return redirect('admin/users')->with('flash_message', 'User deleted!');
    }
}
