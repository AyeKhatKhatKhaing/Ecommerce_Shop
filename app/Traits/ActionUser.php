<?php

namespace App\Traits;

use App\Models\User;


trait ActionUser
{
    public function createUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updateUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}