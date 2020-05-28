<!-- Right Side START -->
        <div class="blog-post-left">
            @if($articles)
            <h4>{{ trans('ru.recent_posts') }}</h4>
                @foreach($articles as $article)
                <div class="recent-posts">
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12 recent-posts-img">
                            <img src="{{ asset(env('MASTER')) }}/img/portfolio/{{ $article->img->mini }}" alt="{{ $article->alias }}">
                        </div>

                        <div class="col-md-7 col-sm-7 col-xs-12 recent-posts-text">
                            <p><a href="{{ route('articles.show',['alias'=>$article->alias]) }}">{{ $article->title }}</a></p>
                            <span>{{ $article->created_at->format('d F, Y') }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
<!-- Right Side END -->
<div class="blog-post-left about">
    <h4>About Us</h4>
    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. </p>
</div>