<ul class="{{$ulClass}} languages-list">
    @foreach($languages as $language)
        @if(\App::getLocale() == $language->slug)
            <li class="active">
        @else
            <li>
        @endif

        <a href="{{$language->href}}">
            {{$language['name'] }}
        </a>
    </li>
    @endforeach
</ul>