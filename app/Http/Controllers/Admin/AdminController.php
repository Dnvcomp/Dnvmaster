<?php

namespace Dnvmaster\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Dnvmaster\Http\Requests;
use Dnvmaster\Http\Controllers\Controller;
use Auth;
use Menu;
class AdminController extends \Dnvmaster\Http\Controllers\Controller
{
    protected $portfolios_repository;
    protected $articles_repository;
    protected $user;
    protected $template;
    protected $content = false;
    protected $title;
    protected $vars;

    public function __construct()
    {
        $this->user = Auth::user();
        if(!$this->user) {
            abort(403);
        }
    }
    public function renderOutput()
    {
        $this->vars = array_add($this->vars,'title',$this->title);
        $menu = $this->getMenu();
        $topBar = view(env('MASTER').'.admin.topBar')->render();
        $this->vars = array_add($this->vars,'topBar',$topBar);
        $navigation = view(env('MASTER').'.admin.navigation')->with('menu',$menu)->render();
        $this->vars = array_add($this->vars,'navigation',$navigation);
        if($this->content) {
            $this->vars = array_add($this->vars,'content',$this->content);
        }
        $footer = view(env('MASTER').'.admin.footer')->render();
        $this->vars = array_add($this->vars,'footer',$footer);
        return view($this->template)->with($this->vars);
    }
    public function getMenu()
    {
        return Menu::make('adminMenu', function($menu) {
            $menu->add('Статьи',array('route'=>'admin.articles.index'));
            $menu->add('Портфолио',array('route'=>'admin.articles.index'));
            $menu->add('Меню',array('route'=>'admin.articles.index'));
            $menu->add('Пользователи',array('route'=>'admin.articles.index'));
            $menu->add('Привилегии',array('route'=>'admin.articles.index'));
        });
    }
}
