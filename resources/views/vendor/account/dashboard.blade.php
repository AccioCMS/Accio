@extends('DefaultTheme.views.index')

@section('header')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="single-author-wrapper">
            {{Auth::user()->avatarImage(200,200, true)}}
            <span class="single-author-content">
                <h1 >{{Auth::user()->fullName}}</h1>
                <p class="blog-description">{{Auth::user()->about}}</p>
            </span>
        </div>
    </div>

    <div class="album text-muteds">
        <div class="container">
            <h1>
                Dashboard
            </h1>
        </div>
    </div>
@endsection
