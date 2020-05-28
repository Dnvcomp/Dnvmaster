@extends(env('MASTER').'.layouts.master')

@section('topBar')
    {!! $topBar !!}
@endsection

@section('navigation')
    {!! $navigation !!}
@endsection

@section('content')
    {!! $content !!}
@endsection

@section('bar')
    {!! $rightBar !!}
@endsection

@section('footer')
    {!! $footer !!}
@endsection