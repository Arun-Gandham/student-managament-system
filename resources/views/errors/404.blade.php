@extends('layout.app')
@section('title',"Unauthorized ")
@section('content')
<a href="{{route('redirect.to.there.page')}}">404 redirect to home page</a>
@endsection
