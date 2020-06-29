<?php

namespace Dnvmaster\Http\Controllers;

use Dnvmaster\Category;
use Dnvmaster\Repositories\ArticlesRepository;
use Dnvmaster\Repositories\CommentsRepository;
use Dnvmaster\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;
use Dnvmaster\Http\Requests;

class ArticlesController extends MasterController
{
    public function __construct(PortfoliosRepository $portfoliosRepository, ArticlesRepository $articlesRepository, CommentsRepository $commentsRepository)
    {
        parent::__construct(new \Dnvmaster\Repositories\MenusRepository(new \Dnvmaster\Menu()));
        $this->portfolios_repository = $portfoliosRepository;
        $this->articles_repository = $articlesRepository;
        $this->comments_repository = $commentsRepository;
        $this->bar = 'right';
        $this->template = env('MASTER').'.articles';
    }

    public function index($cat_alias = false)
    {
        $this->title = 'Статьи';
        $this->description = 'Выполненные работы мастеров';
        $this->keywords = 'Статьи, работы, мастер, ключи, мебель, сантехника, электрика, описание, выполненная работа';

        $articles = $this->getArticles($cat_alias);
        $content = view(env('MASTER').'.articles_content')->with('articles',$articles)->render();
        $this->vars = array_add($this->vars,'content',$content);
        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        $this->contentRightBar = view(env('MASTER').'.articlesBar')->with(['comments'=> $comments,'portfolios'=>$portfolios]);
        return $this->renderOutput();
    }

    public function getComments($take)
    {
        $comments = $this->comments_repository->get(['text','name','email','site','article_id','user_id'],$take);
        if($comments) {
            $comments->load('article','user');
        }
        return $comments;
    }

    public function getPortfolios($take)
    {
        $portfolios = $this->portfolios_repository->get(['title','text','alias','customer','img','filter_alias'],$take);
        return $portfolios;
    }

    public function getArticles($alias = false)
    {
        $where = false;
        if($alias) {
            $id = Category::select('id')->where('alias',$alias)->first()->id;
            $where = ['category_id',$id];
        }
        $articles = $this->articles_repository->get(['id','title','alias','created_at','img','desc','user_id','category_id','keywords','description'],false,true,$where);
        if($articles) {
            $articles->load('user','category','comments');
        }
        return $articles;
    }

    public function show($alias = false)
    {
        $article = $this->articles_repository->one($alias,['comments'=> true]);
        if($article) {
            $article->img = json_decode($article->img);
        }

        if(isset($article->id)) {
            $this->title = $article->title;
            $this->keywords = $article->keywords;
            $this->description = $article->description;
        }
        $content = view(env('MASTER').'.article_content')->with('article',$article)->render();
        $this->vars = array_add($this->vars,'content',$content);
        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));
        $this->contentRightBar = view(env('MASTER').'.articlesBar')->with(['comments'=> $comments,'portfolios'=>$portfolios]);
        return $this->renderOutput();
    }
}
