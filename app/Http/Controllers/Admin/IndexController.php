<?php

namespace Dnvmaster\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Dnvmaster\Http\Requests;
use Dnvmaster\Http\Controllers\Controller;

class IndexController extends AdminController
{
    public function __construct()
    {
       parent::__construct();
       $this->template = env('MASTER').'.admin.index';
    }

    public function index()
    {
        $this->title = 'Панель администратора';
        return $this->renderOutput();
    }
}
