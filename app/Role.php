<?php

namespace Dnvmaster;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany('Dnvmaster\User','role_user');
    }
    public function perms()
    {
        return $this->belongsToMany('Dnvmaster\Permission','permission_role');
    }
}
