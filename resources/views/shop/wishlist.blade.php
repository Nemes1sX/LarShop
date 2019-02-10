@extends('layouts.layout')
@section('title')
    Wishlist
@endsection
@section('content')
@if(Session::has('wishlist'))
<div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <ul class="list-group">
                @foreach($products as $product)
                    <li class="list-group-item">
                        <strong>{{ $product['item']['title'] }}</strong>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@else
<div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <strong style="text-align: center;">Nesate pažymėję pageidaujamos prekės</strong>
        </div>    
</div>   
@endif   
@endsection