<ul class="post-tags-list {{$ulClass}}">
@foreach($tagsList as $tag)
    <li>
        <a href="{{$tag->href}}">
            {{$tag->title}}
        </a>
    </li>
@endforeach
</ul>