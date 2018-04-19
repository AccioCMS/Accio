<figure class="post-featured-image">
    <img  src="{{$imageURL}}" alt="{{$featuredImage->title}}" title="{{$featuredImage->title}}" />
    @if($featuredImage->credit)
        <cite>© {{$featuredImage->credit}}</cite>
    @endif
    <figcaption>
        {{$featuredImage->description}}
    </figcaption>
</figure>