<!-- Start Right Side -->
<div class="blog-post-left">
    <h4>{{ Lang::get('ru.recent_posts') }}</h4>
    @if(!$portfolios->isEmpty())
        @foreach($portfolios as $portfolio)
        <div class="recent-posts">
            <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-12 recent-posts-img">
                    <img src="{{ asset(env('MASTER')) }}/img/portfolio/{{ $portfolio->img->mini }}" style="border-radius: 7px;" alt="{{ $portfolio->title }}">
                </div>

                <div class="col-md-7 col-sm-7 col-xs-12 recent-posts-text">
                    <h5><a href="{{ route('portfolios.show',['alias'=>$portfolio->alias]) }}">{{ $portfolio->title}}</a></h5>
                    <span>{{ str_limit($portfolio->text,50) }}</span><br>
                    <a href="{{ route('portfolios.show',['alias'=>$portfolio->alias]) }}">{{ Lang::get('ru.read_more')}}</a>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
<!-- End Right Side -->

<!-- Start Comment Side -->
@if(!$comments->isEmpty())
    <div class="blog-post-left">
        <h4>{{ Lang::get('ru.recent_comments') }}</h4>
        @foreach($comments as $comment)
            <div class="recent-posts">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12 recent-posts-img">
                        @set($hash,($comment->email) ? md5($comment->email) : $comment->user->email)
                        <img src="https://www.gravatar.com/avatar/{{ $hash }}?d=mm&s=70" class="avatar img-circle img-responsive" alt="Avatar">
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12 recent-posts-text">
                        <a href="{{ route('articles.show',['alias'=>$comment->article->alias]) }}">{{ isset($comment->user) ? $comment->user->name : $comment->name }}</a>
                        <a class="title" href="{{ route('articles.show',['alias'=>$comment->article->alias]) }}">{{ $comment->article->title }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
<!-- End Comment Side -->
