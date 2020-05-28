<!-- Left Side START -->
@if($portfolios && count($portfolios) > 0)
    <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="blog-post">
            @foreach($portfolios as $key => $item)
                @if($key == 0)
                    <img src="{{ asset(env('MASTER')) }}/img/portfolio/{{ $item->img->max }}" class="border-round" alt="{{ $item->title }}">
                    <br>
                    <h2 class="mt-15"><a href="{{ route('portfolios.show',['alias'=>$item->alias]) }}">{{ $item->title }}</a></h2><br>
                    <blockquote>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 blockquote">
                                <p>{!! str_limit($item->text,300) !!}</p>
                                <a href="{{ route('portfolios.show',['alias'=>$item->alias]) }}" class="button-lg button-primary mt-30" data-duration="1150" data-delay="500">{{ trans('ru.read_more') }}</a>
                            </div>
                        </div>
                    </blockquote>
                    @continue
                @endif
            @endforeach
        </div>
    </div>
    @else
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="blog-post">
                <blockquote>
                    <div class="row">
                        <div class="col-md-1 col-sm-1 col-xs-3">
                            <div class="mt-15">
                                <i class="icon-unlink"></i>
                            </div>
                        </div>
                        <div class="col-md-11 col-sm-11 col-xs-9 blockquote">
                            {!! trans('ru.articles_no') !!}
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
@endif
<!-- Left Side END -->