<header>
    <nav class="navbar navbar-default navbar-custom" data-spy="affix" data-offset-top="50">
        <div class="container">
            <div class="row">
                <div class="navbar-header navbar-header-custom">
                    <button type="button" class="navbar-toggle collapsed menu-icon" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-logo" href="{{ url('/') }}"><img src="{{ asset(env('MASTER')) }}/img/logos/logo.png" alt="DnvMaster"></a>
                </div>
            @if($menu)
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right navbar-links-custom">
                            @include(env('MASTER').'.customMenuItems',['items'=>$menu->roots()])
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</header>
