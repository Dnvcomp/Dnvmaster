<?php

namespace Dnvmaster\Repositories;

use Dnvmaster\Permission;
use Gate;

class PermissionsRepository extends Repository
{
    protected $roles_repository;
    public function __construct(Permission $permission, RolesRepository $roles_repository)
    {
        $this->model = $permission;
        $this->roles_repository = $roles_repository;
    }

    public function changePermissions($request)
    {
       if (Gate::denies('change', $this->model)) {
            abort(403);
        }
        $data = $request->except('_token');
        $roles = $this->roles_repository->get();
        foreach($roles as $value) {
            if(isset($data[$value->id])) {
                $value->savePermissions($data[$value->id]);
            } else {
                $value->savePermissions([]);
            }
        }
        return ['status' => 'Права пользователя успешно обновлены'];
    }
}