@foreach($items as $item)
    <li>
        <a href="{{ $item->url() }}">{{ $item->title }}</a>
        <div class="submenu">
            <ul>
            @if($item->hasChildren())
                @include(env('MASTER').'.customMenuItems',['items'=>$item->children()])
            @endif
        </ul>
        </div>
    </li>
@endforeach