<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="service-box clearfix">

        <div class="section-heading text-center">
            <h2>Добавление новых пунктов меню</h2>
        </div>

        {!! Form::open(['url' => (isset($menu->id)) ? route('admin.menus.update',['menus'=>$menu->id]) : route('admin.menus.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}
        <ul class="display-none">
            <div class="service-box clearfix">

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="box-icon">
                        <i class="icon-bookmark"></i>
                    </div>
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="BigLabel">Заголовок:</span>
                            <br>
                            <span class="sublabel">Заголовок пункта</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::text('title',isset($menu->title) ? $menu->title  : old('title'), ['placeholder'=>'Введите название страницы']) !!}
                        </div>
                    </li>
                </div>


                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="box-icon">
                        <i class="icon-bookmark-1"></i>
                    </div>
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="BigLabel">Родительский пункт меню:</span>
                            <br />
                            <span class="sublabel">Родитель:</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('parent', $menus, isset($menu->parent) ? $menu->parent : null) !!}
                        </div>
                    </li>
                </div>
            </div>

        </ul>

        <div class="service-box clearfix">
            <div class="section-heading text-center">
                <h2>Тип меню:</h2>
            </div>


            <div id="accordion">


                <div class="service-box clearfix">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3>{!! Form::radio('type', 'customLink',(isset($type) && $type == 'customLink') ? TRUE : FALSE,['class' => 'radioMenu']) !!}
                            <span class="BigLabel">Пользовательская ссылка:</span>
                        </h3>
                        <div class="mb-15"></div>
                        <ul class="display-none">
                            <li class="text-field">
                                <label for="name-contact-us">
                                    <span class="BigLabel">Путь для ссылки:</span>
                                </label>
                                <div class="primary-form">
                                    {!! Form::text('custom_link',(isset($menu->path) && $type=='customLink') ? $menu->path  : old('custom_link'), ['placeholder'=>'Введите название ссылки']) !!}
                                </div>
                            </li>
                            <div style="clear: both;"></div>
                        </ul>
                    </div>
                </div>

                <div class="service-box clearfix">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3>{!! Form::radio('type', 'blogLink',(isset($type) && $type == 'blogLink') ? TRUE : FALSE,['class' => 'radioMenu']) !!}
                            <span class="BigLabel">Раздел Блог:</span>
                        </h3>
                        <ul class="display-none">
                            <div class="col-md-6 col-sm-6 col-xs-12">
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
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
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
                            </div>
                        </ul>

                    </div>
                </div>

                <div class="service-box clearfix">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3>{!! Form::radio('type', 'portfolioLink',(isset($type) && $type == 'portfolioLink') ? TRUE : FALSE,['class' => 'radioMenu']) !!}
                            <span class="BigLabel">Раздел портфолио:</span>
                        </h3>
                        <ul class="display-none">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <li class="text-field">
                                    <label for="name-contact-us">
                                        <span class="label">Ссылка на запись портфолио:</span>
                                        <br />
                                        <span class="sublabel">Ссылка на запись портфолио</span><br />
                                    </label>
                                    <div class="input-prepend">
                                        {!! Form::select('portfolio_alias', $portfolios, (isset($option) && $option) ? $option :FALSE, ['placeholder' => 'Не используется']) !!}

                                    </div>

                                </li>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
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
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <br>

        @if(isset($menu->id))
            <input type="hidden" name="_method" value="PUT">
        @endif

        <ul class="display-none">
            <li class="submit-button">
                {!! Form::button('Сохранить', ['class' => 'button button-primary','type'=>'submit']) !!}
            </li>
        </ul>

        {!! Form::close() !!}
    </div>
</div>

<script>
    jQuery(function($) {
        $('#accordion').accordion({
            activate: function(e, obj) {
                obj.newPanel.prev().find('input[type=radio]').attr('checked','checked');
            }
        });
        $('#accordion input[type=radio]').each(function (ind,it) {
            if($(this).prop('checked')) {
                active = ind;
            }
        });
        $('#accordion').accordion('option','active',active);
    })
</script>