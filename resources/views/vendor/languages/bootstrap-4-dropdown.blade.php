<ul class="{{$ulClass}} navbar-nav languages-list">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="javascript:;" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{\App::getLocale()}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            @foreach($languages as $language)
                <a class="dropdown-item" href="{{$language->href}}" title="{{$language->name}}">
                    {{$language['name'] }}
                </a>
            @endforeach
        </div>
    </li>
</ul>