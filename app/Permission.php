<?php

namespace Dnvmaster;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany('Dnvmaster\Role','permission_role');
    }
}
