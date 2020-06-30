<?php

namespace Dnvmaster\Http\Controllers\Admin;

use Dnvmaster\Repositories\PermissionsRepository;
use Dnvmaster\Repositories\RolesRepository;
use Illuminate\Http\Request;
use Dnvmaster\Http\Requests;
use Dnvmaster\Http\Controllers\Controller;

class PermissionsController extends AdminController
{
    protected $permissionsRepository;
    protected $rolesRepository;
    public function __construct(PermissionsRepository $permissionsRepository, RolesRepository $rolesRepository)
    {
        parent::__construct();
        if(\Gate::denies('EDIT_USERS')) {
            abort(403);
        }
        $this->permissionsRepository = $permissionsRepository;
        $this->rolesRepository = $rolesRepository;
        $this->template = env('MASTER').'.admin.permissions';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = "Редактирование прав пользователей";
        $roles = $this->getRoles();
        $permissions = $this->getPermissions();
        $this->content = view(env('MASTER').'.admin.permissions_content')->with(['roles'=>$roles,'priv'=>$permissions])->render();
        return $this->renderOutput();
    }

    public function getRoles()
    {
        $roles = $this->rolesRepository->get();
        return $roles;
    }

    public function getPermissions()
    {
        $permissions = $this->permissionsRepository->get();
        return $permissions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
