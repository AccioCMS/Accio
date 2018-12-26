<ul class="{{$ulClass}} {{$menuSlug}}-menu navbar">
    @foreach($menuLinks as $menuLink)
        @if($menuLink->isActive)
            <li class="active">
        @else
            <li>
        @endif
            <a href="{{$menuLink->href}}" title="{{$menuLink->label}}">
                {{$menuLink->label}}
            </a>
        </li>
    @endforeach
</ul>