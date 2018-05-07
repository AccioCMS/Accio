@extends('app')
@section('content')
    <app
        base_url="{{ Request::root() }}"
        base_path="{{ projectDirectory() }}"
    ></app>
@stop
