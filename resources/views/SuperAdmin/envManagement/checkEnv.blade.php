@extends('superAdmin.layouts.main')
@section('title','ENV Data')
@section('content')
<div class="row">
    <div class="col-md-12 mt-5">
        @if($subdomainData !== $dbSubdomainsSerialized)
        <a href="{{route('superadmin.subdomain.update.env')}}" class="btn btn-danger" role="button">Update ENV Subdomains</a>
        @else
        <h4 class="text-success">ENV is up to date</h4>
        @endif
    </div>
    <div class="col-md-6 mt-5">
        <h3>ENV Subdomains Data</h3>
        <table class="border table">
            <thead>
                <tr>
                    <th>Subdomain</th>
                    <th>Strong Id</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subdomainDataUnserialized as $key => $value):
                <tr>
                <td>{{$key}}</td>
                <td>{{$value}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p class="overflow-auto">{{ $subdomainData }}</p>
    </div>
    <div class="col-md-6 mt-5">
        <h3>DB Subdomains Data</h3>
        <table class="table border">
            <thead>
                <tr>
                    <th>Subdomain</th>
                    <th>Strong Id</th>
                </tr>
            </thead>
            <tbody>
                @foreach($availableSubdomains as $key => $value):
                <tr>
                <td>{{$key}}</td>
                <td>{{$value}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p class="overflow-auto">{{$dbSubdomainsSerialized}}</p>
    </div>


</div>
@endsection
