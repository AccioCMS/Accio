<form class="main-search-form {{$formClass}}" method="POST" action="{{route('search.results.post')}}">
    <input type="hidden" name="_token" value="{{Session::token()}}">
    <input class="search-input" type="text" name="keyword" placeholder="{{@trans('search.placeholder')}}" value="{{$keyword}}">
</form>