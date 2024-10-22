@extends('layouts.layout')
@section('title')
    Shopping cart
@endsection
@section('content')
    @if(Session::has('cart'))
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <ul class="list-group">
                @foreach($cart as $item)
                    <li class="list-group-item">
                        <span class="badge badge-secondary">{{ $item['quantity'] }}</span>
                        <strong>{{ $item['name'] }}</strong>
                        <span class="label label-sucess">{{ $item['price']}}€</span>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">Action<span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="{{route ('cart.remove', $item['id'])}}">Remove item</a></li>
                            </ul>    
                        </div>    
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <strong style="text-align: center;">Total: {{ $totalPrice }}€ </strong>
        </div>    
    </div>    
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <button type="button" class="btn btn-sucess">Pay</button>
            <a href="{{route ('cart.remove.all')}}" class="btn btn-danger">Remove cart</a>
        </div>    
    </div>    
    @else
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <strong style="text-align: center;">The cart is empty</strong>
        </div>    
    </div>  
    @endif

@endsection