<div id="top-bar" class="hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-xs-12">
                <ul class="top-bar-info">
                    <li><i class="fa fa-user-circle"></i> {{ Auth::user()->name }}</li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 right-holder hidden-sm">
                <a href="{{ url('/logout') }}" class="top-appoinment">{{ trans('ru.output') }}</a>
            </div>
        </div>
    </div>
</div>