@extends(env('MASTER').'.layouts.master')

@section('content')
    <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
        <form action="{{ url('/login') }}" method="post" class="primary-form">
            {{ csrf_field() }}
            <div class="col-xs-6">
                <input type="text" name="login" id="login" placeholder="Input login">
            </div>
            @if($errors->has('login'))
                <span class="help-block">
                     <strong>{{ $errors->first('login') }}</strong>
                </span>
            @endif
            <div class="col-xs-6">
                <input type="password" name="password" id="password" placeholder="Your password">
            </div>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
            <div class="center-holder">
                <button type="submit" class="button button-primary mt-30">Input</button>
            </div>
        </form>
    </div>
@endsection