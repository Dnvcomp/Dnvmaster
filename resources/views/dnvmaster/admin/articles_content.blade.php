@if($articles)
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="service-box clearfix">
            <div class="section-heading text-center">
                <h2>Добавленные статьи</h2>
            </div>
            <table class="table">
                <thead>
                    <tr class="info">
                        <th class="th-success">ID</th>
                        <th class="th-articles">Заголовок</th>
                        <th class="th-articles">Текст</th>
                        <th class="th-articles">Изображение</th>
                        <th class="th-articles">Категория</th>
                        <th class="th-articles">Автор</th>
                        <th class="th-red">Действие</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr class="warning">
                            <td class="text-left number">{{ $article->id }}</td>
                            <td class="text-left">{!! Html::link(route('admin.articles.edit',['articles'=>$article->alias]),$article->title) !!}</td>
                            <td class="text-left">{{ str_limit($article->text,200)}}</td>
                            <td>
                                @if(isset($article->img->mini))
                                    {!! Html::image(asset(env('MASTER')).'/img/articles/'.$article->img->mini) !!}
                                @endif
                            </td>
                            <td>{{ $article->category->title}}</td>
                            <td>{{ $article->alias }}</td>
                            <td>
                                {!! Form::open(['url'=>route('admin.articles.destroy',['articles'=>$article->alias]),'class'=>'form-horizontal','method'=>'post']) !!}
                                {{ method_field('DELETE') }}
                                {!! Form::button('Удалить',['class'=>'btn btn-danger','type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! Html::link(route('admin.articles.create'),'Добавить  материал',['class' => 'button button-primary']) !!}
        </div>
    </div>
@endif