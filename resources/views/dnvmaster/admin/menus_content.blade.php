<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="service-box clearfix">
        <div class="section-heading text-center">
            <h3>Редактрование меню</h3>
        </div>
        <table class="table">
            <thead>
            <tr class="info">
                <th>Имя</th>
                <th>Ссылка</th>
                <th>Удалить</th>
            </tr>
            </thead>
            @if($menus)
                @include(env('MASTER').'.admin.custom-menu-items', array('items'=> $menus->roots(),'paddingLeft'=>''))
            @endif
        </table>
    </div>
    {!! HTML::link(route('admin.menus.create'),'Добавить  пункт',['class' => 'button button-primary mt-20']) !!}
</div>