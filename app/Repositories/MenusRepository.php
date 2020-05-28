<?php

namespace Dnvmaster\Repositories;

use Dnvmaster\Menu;

class MenusRepository extends Repository
{
    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }
}