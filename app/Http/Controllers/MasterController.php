<?php

namespace Dnvmaster\Http\Controllers;

use Dnvmaster\Repositories\MenusRepository;
use Illuminate\Http\Request;
use Dnvmaster\Http\Requests;
use Menu;

class MasterController extends Controller
{
    protected $portfolios_repository;
    protected $sliders_repository;
    protected $articles_repository;
    protected $comments_repository;
    protected $menus_repository;

    protected $keywords;
    protected $description;
    protected $title;


    protected $template;
    protected $vars = array();
    protected $contentRightBar = false;
    protected $contentLeftBar = false;
    protected $bar = 'no';

    public function __construct(MenusRepository $menus_repository)
    {
        $this->menus_repository = $menus_repository;
    }

    protected function renderOutput()
    {
        $menu = $this->getMenu();

        $topBar = view(env('MASTER').'.topBar')->render();
        $this->vars=array_add($this->vars,'topBar',$topBar);

        $navigation = view(env('MASTER').'.navigation')->with('menu',$menu)->render();
        $this->vars=array_add($this->vars,'navigation',$navigation);

        if($this->contentRightBar) {
            $rightBar = view(env('MASTER').'.rightBar')->with('content_rightBar',$this->contentRightBar)->render();
            $this->vars = array_add($this->vars,'rightBar',$rightBar);
        }
        $this->vars = array_add($this->vars,'bar',$this->bar);

        $this->vars = array_add($this->vars,'keywords',$this->keywords);
        $this->vars = array_add($this->vars,'description',$this->description);
        $this->vars = array_add($this->vars,'title',$this->title);

        $footer = view(env('MASTER').'.footer')->render();
        $this->vars=array_add($this->vars,'footer',$footer);

        return view($this->template)->with($this->vars);
    }

    protected function getMenu()
    {
        $menu = $this->menus_repository->get();
        $mBuilder = Menu::make('MyNav', function($m) use($menu) {
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
        return $mBuilder;
    }
}
