<?php

namespace Dnvmaster\Http\Controllers\Admin;

use Menu;
use Dnvmaster\Repositories\ArticlesRepository;
use Dnvmaster\Repositories\MenusRepository;
use Dnvmaster\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;
use Dnvmaster\Http\Requests;
use Dnvmaster\Http\Controllers\Controller;
use Gate;

class MenusController extends AdminController
{
    protected $menus_repository;
    public function __construct(MenusRepository $menus_repository, ArticlesRepository $articlesRepository, PortfoliosRepository $portfoliosRepository)
    {
        parent::__construct();
        if(Gate::denies('VIEW_ADMIN_MENU')) {
            abort(403);
        }
        $this->menus_repository = $menus_repository;
        $this->articles_repository = $articlesRepository;
        $this->portfolios_repository = $portfoliosRepository;
        $this->template = env('MASTER').'.admin.menus';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = $this->getMenus();
        $this->content = view(env('MASTER').'.admin.menus_content')->with('menus',$menu)->render();
        return $this->renderOutput();
    }
    public function getMenus()
    {
        $menu = $this->menus_repository->get();
        if($menu->isEmpty()) {
            return false;
        }
        return Menu::make('forMenuPart', function($m) use($menu) {
            foreach($menu as $item) {
                if($item->parent == 0) {
                    $m->add($item->title,$item->path)->id($item->id);
                } else {
                    if($m->find($item->parent)) {
                        $m->find($item->parent)->add($item->title,$item->path)->id($item->id);
                    }
                }
            }
        });
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
