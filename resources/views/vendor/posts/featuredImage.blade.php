<figure class="post-featured-image">
    <img  src="{{$imageURL}}" alt="{{$featuredImage->description}}" title="{{$featuredImage->title}}" class="img-responsive"/>
    @if($featuredImage->description || $featuredImage->credit)
        <figcaption>
            @if($featuredImage->credit)
                <cite>© {{$featuredImage->credit}}</cite>
            @endif

            @if($featuredImage->description)
                <span>{{$featuredImage->description}}</span>
            @endif
        </figcaption>
    @endif
</figure>