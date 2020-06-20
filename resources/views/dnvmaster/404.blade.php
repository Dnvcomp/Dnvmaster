@extends(env('MASTER').'.layouts.master')

@section('topBar')
    @include(env('MASTER').'.topBar')
@endsection

@section('navigation')
    {!! $navigation !!}
@endsection

@section('content')
    <div class="big-background" style=" background-image: url('{{ asset(env('MASTER')) }}/img/errors/404.png');">
        <div class="block-404">
            <h1>Страница не найдена.</h1>
            <h2>Вы указали неправильный URL адрес страницы.</h2>
            <h4>Запрашиваемая Вами страница, была удалена или переименована.</h4>
            <p>Если Вы желаете продолжить просмотр и чтение страниц, пожалуйста перейдите на главную страницу, нажав на кнопку ниже.</p>
            <div class="center-holder">
                <a href="{{ url('/') }}" class="button button-primary mt-30">На главную</a>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include(env('MASTER').'.footer')
@endsection