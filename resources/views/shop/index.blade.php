@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="sorting">
        <select name="sorting">
            <option value="price"><a href="#">Rūšiuoti pagal kainą</a></option>
            <option value="text"><a href="#">Rūšiuoti pagal pavadinimą</a></option>
        </select>
    </div>    
</div>
@foreach($products->chunk(3) as $chunk)
<div class="row">
    @foreach($chunk as $product)
    <div class="col-sm-6 col-md-4 col-lg-4">
        <div class="thumbnail product" style="width: 18rem;">
            <img class="card-img-top thumbnail img-responsive" src="{{$product->imagePath}}" alt="Card image cap">
            <div class="caption">
                <h5 class="card-title">{{$product->title}}</h5>
                <p class="card-text">Kategorija: {{$product->category}}</p>
                <p class="card-text">{{$product->description}}</p>
                <div class="clearfix">
                    <div class="center">
                        <h3 class="price">{{$product->price}}€</h3>
                        <a href="#" class="btn btn-primary wishlist"><i class="fas fa-heart"></i> Įdėti į Wishlist</a>
                        <a href="{{ route('product.addToCart')}}" class="btn btn-success  cart"><i class="fas fa-shopping-cart"></i>Pridėti į krepšelį</a>
                    </div>
                </div>
            </div>
        </div> 
    </div>    
    @endforeach  
</div>    
@endforeach    
@endsection  
