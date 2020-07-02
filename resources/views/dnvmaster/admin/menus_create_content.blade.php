<div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-3">
    <div class="section-heading text-center">
        <h3>Добавление новых пунктов меню</h3>
    </div>
    <div class="row">
        {!! Form::open(['url' => (isset($menu->id)) ? route('admin.menus.update',['menus'=>$menu->id]) : route('admin.menus.store'),'class'=>'primary-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="service-box clearfix">
                <div class="box-icon">
                    <i class="icon-file-1"></i>
                </div>
                <div class="box-content">
                    <h5>Заголовок пункта</h5>
                    {!! Form::text('title',isset($menu->title) ? $menu->title  : old('title'), ['placeholder'=>'Введите пункт меню']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="service-box clearfix">
                <div class="box-icon">
                    <i class="icon-file-1"></i>
                </div>
                <div class="box-content">
                    <h5>Родительский пункт</h5>
                    <div class="mb-40"></div>
                    {!! Form::select('parent', $menus, isset($menu->parent) ? $menu->parent : null) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="service-box clearfix">
            <div class="mt-50"></div>
            <div class="section-heading text-center">
                <h3>Тип меню</h3>
            </div>

            <div id="accordion">

                <h3>{!! Form::radio('type', 'customLink',(isset($type) && $type == 'customLink') ? TRUE : FALSE,['class' => 'radioMenu']) !!}
                    <span class="label">Пользовательская ссылка:</span>
                </h3>
                <ul>
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Путь для ссылки:</span>
                            <br />
                            <span class="sublabel">Путь для ссылки</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                            {!! Form::text('custom_link',(isset($menu->path) && $type=='customLink') ? $menu->path  : old('custom_link'), ['placeholder'=>'Введите название страницы']) !!}
                        </div>
                    </li>
                    <div style="clear: both;"></div>
                </ul>

                <h3>{!! Form::radio('type', 'blogLink',(isset($type) && $type == 'blogLink') ? TRUE : FALSE,['class' => 'radioMenu']) !!}
                    <span class="label">Раздел Блог:</span>
                </h3>
                <ul>
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Ссылка на категорию блога:</span>
                            <br />
                            <span class="sublabel">Ссылка на категорию блога</span><br />
                        </label>
                        <div class="input-prepend">

                            @if($categories)
                                {!! Form::select('category_alias',$categories,(isset($option) && $option) ? $option :FALSE) !!}
                            @endif
                        </div>
                    </li>

                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Ссылка на материал блога:</span>
                            <br />
                            <span class="sublabel">Ссылка на материал блога</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('article_alias', $articles, (isset($option) && $option) ? $option :FALSE, ['placeholder' => 'Не используется']) !!}
                        </div>
                    </li>
                    <div style="clear: both;"></div>
                </ul>

                <h3>{!! Form::radio('type', 'portfolioLink',(isset($type) && $type == 'portfolioLink') ? TRUE : FALSE,['class' => 'radioMenu']) !!}
                    <span class="label">Раздел портфолио:</span>
                </h3>
                <ul>

                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Ссылка на запись портфолио:</span>
                            <br>
                            <span class="sublabel">Ссылка на запись портфолио</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('portfolio_alias', $portfolios, (isset($option) && $option) ? $option :FALSE, ['placeholder' => 'Не используется']) !!}
                        </div>
                    </li>

                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Портфолио:</span>
                            <br />
                            <span class="sublabel">Портфолио</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('filter_alias', $filters, (isset($option) && $option) ? $option :FALSE, ['placeholder' => 'Не используется']) !!}
                        </div>
                    </li>
                </ul>
            </div> <!-- # End accordion -->
        </div><!-- # End clearfix -->

        @if(isset($menu->id))
            <input type="hidden" name="_method" value="PUT">
        @endif
    </div>
    {!! Form::button('Сохранить', ['class' => 'button button-primary mt-30','type'=>'submit']) !!}
    {!! Form::close() !!}
</div>