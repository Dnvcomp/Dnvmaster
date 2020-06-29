<div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-3">
    <div class="section-heading text-center">
        <h3>Добавление нового материала</h3>
    </div>
    <div class="row">
        {!! Form::open(['url' => (isset($article->id)) ? route('admin.articles.update',['articles'=>$article->alias]) : route('admin.articles.store'),'class'=>'primary-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="service-box clearfix">
                <div class="box-icon">
                    <i class="icon-file-1"></i>
                </div>
                <div class="box-content">
                    <h5>Заголовок материала</h5>
                    {!! Form::text('title',isset($article->title) ? $article->title  : old('title'), ['placeholder'=>'Введите заголовок материала']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="service-box clearfix">
                <div class="box-icon">
                    <i class="icon-file-2"></i>
                </div>
                <div class="box-content">
                    <h5>Ключевые слова</h5>
                    {!! Form::text('keywords', isset($article->keywords) ? $article->keywords  : old('keywords'), ['placeholder'=>'Введите ключевые слова']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="service-box clearfix">
                <div class="box-icon">
                    <i class="icon-user-3"></i>
                </div>
                <div class="box-content">
                    <h5>Логин Псевдоним Имя</h5>
                    {!! Form::text('alias', isset($article->alias) ? $article->alias  : old('alias'), ['placeholder'=>'Логин Псевдоним или имя автора']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="service-box clearfix">
                <div class="box-icon">
                    <i class="icon-file-2"></i>
                </div>
                <div class="box-content">
                    <h5>Мета описание</h5>
                    {!! Form::text('description', isset($article->description) ? $article->description  : old('description'), ['placeholder'=>'Введите мета описание для страницы']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="service-box clearfix">
               <div class="box-icon">
                    <i class="icon-file"></i>
                </div>
                <div class="box-content">
                    <h5>Краткое описание статьи:</h5>
                    <div class="mb-30"></div>
                    {!! Form::textarea('desc', isset($article->desc) ? $article->desc  : old('desc'), ['id'=>'editor','class' => 'form-control','placeholder'=>'Введите краткое описание статьи']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="service-box clearfix">
                <div class="box-icon">
                    <i class="icon-file"></i>
                </div>
                <div class="box-content">
                    <h5>Полное описание статьи:</h5>
                    <div class="mb-30"></div>
                    {!! Form::textarea('text', isset($article->text) ? $article->text  : old('text'), ['id'=>'editor2','class' => 'form-control','placeholder'=>'Введите полное описание статьи']) !!}
                </div>
            </div>
        </div>
        <div class="service-box clearfix">
            @if(isset($article->img->path))
                <div class="box-content">
                    <h5>Изображение материала:</h5>
                    {{ Html::image(asset(env('MASTER')).'/img/articles/'.$article->img->path,'',['style'=>'width:400px']) }}
                    {!! Form::hidden('old_image',$article->img->path) !!}
                </div>
            @endif
        </div>
        <div class="service-box clearfix">
            <div class="box-content">
                <h5>Изображение материала:</h5>
                {!! Form::file('image', ['class' => 'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
            </div>
        </div>

        <div class="service-box clearfix">
            <div class="box-content">
                <h5>Категория материала</h5>
                {!! Form::select('category_id', $categories,isset($article->category_id) ? $article->category_id  : '') !!}
            </div>
        </div>

        @if(isset($article->id))
            <input type="hidden" name="_method" value="PUT">
        @endif
        <div class="submit-button">
            {!! Form::button('Сохранить', ['class' => 'button button-primary mt-30','type'=>'submit']) !!}
        </div>
        {!! Form::close() !!}
        <script>
            CKEDITOR.replace('editor');
            CKEDITOR.replace('editor2');
        </script>
    </div>
</div>