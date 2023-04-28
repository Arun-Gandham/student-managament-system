@extends('layout.app')
@section('title',"Unauthorized ")
@section('content')
<a href="{{route('redirect.to.there.page')}}">redirect to home page</a>
@endsection
