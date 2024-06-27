<?php

namespace App\Traits;

trait AdminRolePermission
{
    public function adminHasRole($role = '')
    {
        if(!auth()->user()->hasRole($role)) abort(403);

    }

    public function adminHasPermission($permission = '')
    {
        if(auth()->user()->cannot($permission)) return true;
    }
}