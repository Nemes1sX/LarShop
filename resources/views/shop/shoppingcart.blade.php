@extends('layouts.layout')
@section('title')
    Shopping cart
@endsection
@section('content')
    @if(Session::has('cart'))
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <ul class="list-group">
                @foreach($products as $product)
                    <li class="list-group-item">
                        <span class="badge badge-secondary">{{ $product['qty'] }}</span>
                        <strong>{{ $product['item']['title'] }}</strong>
                        <span class="label label-sucess">{{ $product['price']}}€</span>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">Action<span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Sumažinti 1</a></li>
                                <li><a href="#">Ištrinti viską</a></li>
                            </ul>    
                        </div>    
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <strong style="text-align: center;">Suma: {{ $totalPrice }}€ </strong>
        </div>    
    </div>    
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <button type="button" class="btn btn-sucess">Susimokėti</button>
        </div>    
    </div>    
    @else
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-md-offset-3 col-sm-offset-3 col-lg-offset-3">
            <strong style="text-align: center;">Nėra prekių krepšelyje</strong>
        </div>    
    </div>  
    @endif

@endsection