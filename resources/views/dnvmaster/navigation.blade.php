@if($menu)
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right topmenu">
            @include(env('MASTER').'.customMenuItems',['items'=>$menu->roots()])
        </ul>
    </div>
@endif
