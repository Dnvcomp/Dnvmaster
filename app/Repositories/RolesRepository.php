<?php

namespace Dnvmaster\Repositories;

use Dnvmaster\Role;

class RolesRepository extends Repository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }
}