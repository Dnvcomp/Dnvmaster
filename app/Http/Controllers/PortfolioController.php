<?php

namespace Dnvmaster\Http\Controllers;

use Dnvmaster\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;

use Dnvmaster\Http\Requests;

class PortfolioController extends MasterController
{
    public function __construct(PortfoliosRepository $portfoliosRepository)
    {
        parent::__construct(new \Dnvmaster\Repositories\MenusRepository(new \Dnvmaster\Menu()));
        $this->portfolios_repository = $portfoliosRepository;
        $this->template = env('MASTER').'.portfolios';
    }
    public function index()
    {
        $this->title = 'Мастера работ';
        $this->keywords = 'Авторы, Работы, Мастера, Выполненные, Сделанные, Изготовленные, Добавленные';
        $this->description = 'Работы выполненные мастерами';
        $portfolios = $this->getPortfolios();
        $content = view(env('MASTER').'.portfolios_content')->with('portfolios',$portfolios)->render();
        $this->vars = array_add($this->vars,'content',$content);
        return $this->renderOutput();
    }
    public function getPortfolios($take = false, $paginate = true)
    {
        $portfolios = $this->portfolios_repository->get('*',$take, $paginate);
        if($portfolios) {
            $portfolios->load('filter');
        }
        return $portfolios;
    }
    public function show($alias)
    {
        $portfolio =$this->portfolios_repository->one($alias);
        $portfolios = $this->getPortfolios(config('settings.other_portfolios'),false);

        $this->title = $portfolio->title;
        $this->keywords = $portfolio->keywords;
        $this->description = $portfolio->description;

        $content = view(env('MASTER').'.portfolio_content')->with(['portfolio' => $portfolio,'portfolios'=> $portfolios])->render();
        $this->vars = array_add($this->vars,'content',$content);

        return $this->renderOutput();
    }
}
