<!-- Articles left side -->
@if($articles)
<div class="col-md-8 col-sm-8 col-xs-12">
    @foreach($articles as $article)
    <div class="blog-post">
        <img src="{{ asset(env('MASTER')) }}/img/articles/{{ $article->img->path }}" alt="{{ $article->title }}" class="mt-50">
        <h4><a href="{{ route('articles.show',['alias'=>$article->alias]) }}">{{ $article->title }}</a></h4>
        <div class="mt-25"></div>
        <div class="blog-post-info">
            <i class="fa fa-calendar"></i><span>{{ $article->created_at->format('d F Y') }}</span>
        </div>
        <div class="blog-post-info">
            <i class="fa fa-user-circle"></i><span>{{ $article->user->name }}</span>
        </div>
        <div class="blog-post-info">
            <i class="fa fa-folder-open-o"></i><span><a href="{{ route('articlesCat',['cat_alias'=>$article->category->alias]) }}">{{ $article->category->title }}</a></span>
        </div>
        <div class="blog-post-info">
            <i class="fa fa-comments-o"></i><a href="#comments"><span>{{ count($article->comments) ? count($article->comments) : '0' }}&nbsp;{{ Lang::choice('ru.comments',count($article->comments)) }}</span></a>
        </div>
        <p class="mt-35">{!! $article->desc !!}</p>
        <a class="button-primary mt-30 mb-50" href="{{ route('articles.show',['alias'=>$article->alias]) }}">{{ Lang::get('ru.read_more') }}</a>
    </div>
    @endforeach
    <div class="mt-50"></div>
    <!-- Start area Pagination -->
        <div aria-label="Pagination">
            <ul class="pager">
                @if($articles->lastPage() > 1)
                    @if($articles->currentPage() !== 1)
                        <li><a style="color: #FFFFFF; background-color: #18ba60; font-size: 16px;" href="{{ $articles->url(($articles->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a></li>
                    @endif

                    @for($i = 1; $i <= $articles->lastPage(); $i++ )
                        @if($articles->currentPage() == $i)
                            <li><a class="disabled">{{ $i }}</a></li>
                        @else
                            <li><a href="{{ $articles->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endfor

                    @if($articles->currentPage() !== $articles->lastPage())
                        <li><a style="color: #FFFFFF; background-color: #18ba60; font-size: 16px;" href="{{ $articles->url(($articles->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a></li>
                    @endif
                @endif
            </ul>
        </div>
        <!-- End area Pagination -->
</div>
@else
    <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="blog-post">
            {!! Lang::get('ru.articles_no') !!}
        </div>
    </div>
@endif
<!-- // Articles left side -->