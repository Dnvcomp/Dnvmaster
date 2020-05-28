<div class="col-md-8 col-sm-8 col-xs-12">
    @if($article)
        <div class="blog-post">
            <img src="{{ asset(env('MASTER')) }}/img/articles/{{ $article->img->path }}" alt="{{ $article->title }}">
            <div class="mt-25"></div>
            <h4>{{ $article->title }}</h4>
            <p class="mt-40">{!! $article->text !!}</p>
            <div class="blog-post-share">
                <div class="blog-post-info">
                    <i class="fa fa-calendar"></i><span>{{ $article->created_at->format('d F Y') }}</span>
                </div>
                <div class="blog-post-info">
                    <i class="fa fa-user-circle"></i><span>{{ $article->user->name }}</span>
                </div>
                <div class="blog-post-info">
                    <i class="fa fa-folder-open-o"></i><span><a href="{{ route('articlesCat',['cat_alias'=>$article->category->alias]) }}">{{ $article->category->title }}</a></span>
                </div>
            </div>
        </div>
        <!-- START COMMENTS -->
        <div class="mt-75"></div>
            @if(count($article->comments) > 0)
                @set($com,$article->comments->groupBy('parent_id'))
                <div id="comments">
                    <ol class="commentlist group">
                        <h3><i class="fa fa-comments-o" style="color: #18ba60;">&nbsp;</i><span>{{ count($article->comments) ? count($article->comments) : '0' }}&nbsp;{{ Lang::choice('ru.comments',count($article->comments)) }}</span></h3>
                        <div class="mt-25"></div>
                            @foreach($com as $key => $comments)
                                @if($key !== 0)
                                    @break
                                @endif
                                @include(env('MASTER').'.comment',['items' => $comments])
                            @endforeach
                        </ol>
                    @endif
                <!-- START TRACKBACK & PINGBACK -->

                <ol class="trackbacklist"></ol>
                <!-- END TRACKBACK & PINGBACK -->
                <div class="mt-70"></div>
                <div id="respond">
                    <h3 id="reply-title">{{ trans('ru.Add') }} &nbsp;<span>{{ trans('ru.comment') }} & &nbsp;<a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">{{ trans('ru.Cancel_reply') }}</a></span></h3>
                    <div class="mt-35"></div>
                    <form action="{{ route('comment.store') }}" method="post" id="commentform">
                        @if(!Auth::check())
                            <div class="form-group">
                                <label for="exampleInputName2">Имя</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Master">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail2">Е-мэйл</label>
                                <input type="email" class="form-control" name="email" id="Email" placeholder="master@dnvmaster.ru">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName2">Сайт</label>
                                <input type="text" class="form-control" id="url" name="site" placeholder="http://dnvmaster.ru">
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="comment">Ваш комментарий</label>
                            <textarea class="form-control" id="comment" name="text" cols="40" rows="7" placeholder="Введите текст комментария"></textarea>
                        </div>
                        <div class="clear"></div>
                        <p>
                            {{ csrf_field() }}
                            <input id="comment_post_ID" type="hidden" name="comment_post_ID" value="{{ $article->id }}">
                            <input id="comment_parent" type="hidden" name="comment_parent" value="0">
                            <input name="submit" type="submit" id="submit" value="Post Comment" >
                        </p>
                    </form>
                </div><!-- #respond -->
            </div>
            <!-- END COMMENTS -->
        @endif
</div>