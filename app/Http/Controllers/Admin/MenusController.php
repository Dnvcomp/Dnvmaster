<?php

namespace Dnvmaster\Http\Controllers\Admin;

use Menu;
use Dnvmaster\Repositories\ArticlesRepository;
use Dnvmaster\Repositories\MenusRepository;
use Dnvmaster\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;
use Dnvmaster\Http\Requests;
use Dnvmaster\Http\Requests\MenusRequest;
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
        # New user link
        $this->title = "Новый пункт меню";
        $temp = $this->getMenus()->roots();
        $menus = $temp->reduce(function($returnMenus, $menu) {
            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;
        },['0' => 'Родительский пункт меню']);
        # Category
        $categories = \Dnvmaster\Category::select(['title','alias','parent_id','id'])->get();
        $list = array();
        $list = array_add($list,'0','Не используется');
        $list = array_add($list,'parent','Раздел статьи');
        foreach($categories as $category) {
            if($category->parent_id == 0) {
                $list[$category->title] = array();
            } else {
                $list[$categories->where('id',$category->parent_id)->first()->title][$category->alias] = $category->title;
            }
        }
        # Articles
        $articles = $this->articles_repository->get(['id','title','alias']);
        $articles = $articles->reduce(function($returnArticles, $article) {
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
        }, []);
        # Filters
        $filters = \Dnvmaster\Filter::select('id','title','alias')->get()->reduce(function ($returnFilters, $filter) {
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
        }, ['parent' => 'Раздел авторы']);
        # Portfolio
        $portfolios = $this->portfolios_repository->get(['id','alias','title'])->reduce(function ($returnPortfolios, $portfolio) {
            $returnPortfolios[$portfolio->alias] = $portfolio->title;
            return $returnPortfolios;
        }, []);
        # Input display
        $this->content = view(env('MASTER').'.admin.menus_create_content')->with(['menus'=>$menus,'categories'=>$list,'articles'=>$articles,'filters' => $filters,'portfolios' => $portfolios])->render();
        return $this->renderOutput();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenusRequest $request)
    {
        $result = $this->menus_repository->addMenu($request);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
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
    public function edit(\Dnvmaster\Menu $menu)
    {
        $this->title = 'Редактирование - '.$menu->title;

        $type = false;
        $option = false;

        $route = app('router')->getRoutes()->match(app('request')->create($menu->path));

        $aliasRoute = $route->getName();
        $parameters = $route->parameters();

        if ($aliasRoute == 'articles.index' || $aliasRoute == 'articlesCat') {
            $type = 'blogLink';
            $option = isset($parameters['cat_alias']) ? $parameters['cat_alias'] : 'parent';
        }

        else if ($aliasRoute == 'articles.show') {
            $type = 'blogLink';
            $option = isset($parameters['alias']) ? $parameters['alias'] : '';
        }

        else if ($aliasRoute == 'portfolios.index') {
            $type = 'portfolioLink';
            $option = 'parent';
        }

        else if($aliasRoute == 'portfolios.show') {
            $type = 'portfolioLink';
            $option = isset($parameters['alias']) ? $parameters['alias'] : '' ;
        }

        else {
            $type = 'customLink';
        }

        $temp = $this->getMenus()->roots();
        $menus = $temp->reduce(function($returnMenus, $menu) {
            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;
        }, ['0' => 'Родительский пункт меню']);

        $categories = \Dnvmaster\Category::select(['title','alias','parent_id','id'])->get();
        $list = array();
        $list = array_add($list,'0','Не используется');
        $list = array_add($list,'parent', 'Раздел статьи');
        foreach($categories as $category) {
            if($category->parent_id == 0) {
                $list[$category->title] = array();
            }
            else {
                $list[$categories->where('id',$category->parent_id)->first()->title][$category->alias] = $category->title;
            }
        }

        $articles = $this->articles_repository->get(['id','title','alias']);
        $articles = $articles->reduce(function($returnArticles, $article) {
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
        }, []);

        $filters = \Dnvmaster\Filter::select('id','title','alias')->get()->reduce(function($returnFilters, $filter) {
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
        }, ['parent' => 'Раздел авторы']);

        $portfolios = $this->portfolios_repository->get(['id','alias','title'])->reduce(function ($returnPortfolios, $portfolio) {
            $returnPortfolios[$portfolio->alias] = $portfolio->title;
            return $returnPortfolios;
        }, []);

        $this->content = view(env('MASTER').'.admin.menus_create_content')->with(['menu' => $menu,'type' => $type,'option' => $option,'menus'=>$menus,'categories'=>$list,'articles'=>$articles,'filters' => $filters,'portfolios' => $portfolios])->render();
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \Dnvmaster\Menu $menu)
    {
        $result = $this->menus_repository->updateMenu($request, $menu);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\Dnvmaster\Menu $menu)
    {
        $result = $this->menus_repository->deleteMenu($menu);
        if(is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }
}
