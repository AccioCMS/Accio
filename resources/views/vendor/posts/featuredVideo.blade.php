<figure>
    <video controls class="post-featured-video">
        <img src='{{asset($featuredVideo->url)}}' alt='{{asset($featuredVideo->description)}}' title='{{asset($featuredVideo->title)}}' />
        <source src='{{asset($featuredVideo->url)}}' type='video/{{$featuredVideo->extension}}' />
     </video>
    @if($featuredVideo->description || $featuredVideo->credit)
        <figcaption>
            @if($featuredVideo->description)
                <span>{{$featuredVideo->description}}</span>
            @endif
            @if($featuredVideo->credit)
                <cite>© {{$featuredVideo->credit}}</cite>
            @endif
        </figcaption>
    @endif
</figure>