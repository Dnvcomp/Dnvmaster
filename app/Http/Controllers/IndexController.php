<?php

namespace Dnvmaster\Http\Controllers;

use Dnvmaster\Repositories\ArticlesRepository;
use Dnvmaster\Repositories\PortfoliosRepository;
use Dnvmaster\Repositories\SlidersRepository;
use Illuminate\Http\Request;
use Dnvmaster\Http\Requests;
use Config;

class IndexController extends MasterController
{

    public function __construct(SlidersRepository $sliders_repository, PortfoliosRepository $portfolios_repository, ArticlesRepository $articlesRepository)
    {
        parent::__construct(new \Dnvmaster\Repositories\MenusRepository(new \Dnvmaster\Menu()));
        $this->sliders_repository = $sliders_repository;
        $this->portfolios_repository = $portfolios_repository;
        $this->articles_repository = $articlesRepository;
        $this->bar = 'right';
        $this->template = env('MASTER').'.index';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = $this->getPortfolio();

        $content = view(env('MASTER').'.content')->with('portfolios',$portfolios)->render();
        $this->vars = array_add($this->vars,'content',$content);

        $partner = view(env('MASTER').'.partner')->with('portfolios',$portfolios)->render();
        $this->vars = array_add($this->vars,'partner',$partner);

        $sliderItems = $this->getSliders();

        $sliders = view(env('MASTER').'.sliders')->with('sliders',$sliderItems)->render();
        $this->vars = array_add($this->vars,'sliders',$sliders);

        $this->keywords = 'DnvMaster, Услуги, Ремонт, Сантехника, Электрика, Сборка мебели, Счётчики воды, Замена труб, Укладка ламината, Укладка линолиума';
        $this->description = 'DnvMaster - Ваш домашний помощник';
        $this->title = 'DnvMaster';

        $articles = $this->getArticles();

        $this->contentRightBar =view(env('MASTER').'.indexBar')->with('articles',$articles)->render();

        return $this->renderOutput();
    }

    protected function getArticles()
    {
        $articles = $this->articles_repository->get(['title','created_at','img','alias'],Config::get('settings.home_articles_count'));
        return $articles;
    }

    protected function getPortfolio()
    {
        $portfolio = $this->portfolios_repository->get('*',Config::get('settings.home_port_count'));
        return $portfolio;
    }

    public function getSliders()
    {
        $sliders = $this->sliders_repository->get();
        if($sliders->isEmpty()) {
            return false;
        }
        $sliders->transform(function($item,$key) {
            $item->img = Config::get('settings.slider_path').'/'. $item->img;
            return $item;
        });
        return $sliders;
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
