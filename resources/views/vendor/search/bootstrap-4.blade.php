<form class="main-search-form {{$formClass}}" method="POST" action="{{route('search.results.post')}}">
    {{ csrf_field() }}
    <input class="form-control mr-sm-2" type="text" name="keyword" placeholder="{{@trans('search.placeholder')}}" value="{{$keyword}}">
</form>