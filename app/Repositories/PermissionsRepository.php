<?php

namespace Dnvmaster\Repositories;

use Dnvmaster\Permission;

class PermissionsRepository extends Repository
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }
}