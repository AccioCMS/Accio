<ul class="{{$ulClass}} {{$menuSlug}}-menu navbar-nav">
    @foreach($menuLinks as $menuLink)
        <li class="{{$menuLink->isActive("active")}}">
        @if($menuLink->children)
            {{-- SECOND LEVEL--}}
            <ul class="navbar-nav">
                <li class="nav-item dropdown {{$menuLink->isActive("active")}}">
                    <a class="nav-link dropdown-toggle" href="{{$menuLink->href}}" data-toggle="dropdown">
                        {{$menuLink->label}}
                    </a>
                    <div class="dropdown-menu" >
                        @foreach($menuLink->children as $subMenuLink)
                            <a class="dropdown-item {{$menuLink->isActive("active")}}"  href="{{$menuLink->href}}" title="{{$subMenuLink->label}}">
                                {{$subMenuLink->label}}
                            </a>

                            {{-- THIRD LEVEL--}}
                        @endforeach
                    </div>
                </li>
            </ul>
        @else
            {{-- FIRST LEVEL--}}
            <a class="nav-link" href="{{$menuLink->href}}" title="{{$menuLink->label}}">
                {{$menuLink->label}}
            </a>
        @endif
        </li>
    @endforeach
</ul>