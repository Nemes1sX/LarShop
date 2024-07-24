@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="sorting">
        <form class="form-control" method="post" action="{{ url ('sorting') }}">
            @csrf
            @method('POST')
            <!--<label>Grupuoti</label>--> 
            <!--<label>Filtruoti</label>-->
            <select name="category">
                <option value="all">Visi</option> 
                <option value="Degtinė">Vodka</option>
                <option value="Viskis">Whiskey</option>
            </select>
           <!-- <label>Rūšiuoti</label>-->
            <select name="ascdesc">
                <option value="priceasc">Price 1-100</option>
                <option value="pricedesc">Price 100-1</option>
                <option value="nameasc">Name A-Z</option>
                <option value="namedesc">Name Z-A</option>
            </select>
            <button type="submit" class="btn btn-success">Sort</button>    
        </form>    
    </div>    
</div>
@forelse($products->chunk(3) as $chunk) 
<div class="row">
    @foreach($chunk as $product) 
    <div class="col-sm-6 col-md-4 col-lg-4">
        <div class="thumbnail product" style="width: 18rem;">
            <img class="card-img-top thumbnail img-responsive" src="{{$product->imagePath}}" alt="Card image cap">
            <div class="caption">
                <h5 class="card-title">{{$product->title}}</h5>
                <p class="card-text">Category: {{$product->category}}</p>
                <p class="card-text">Country: {{$product->country}}</p>
                <p class="card-text">{{$product->description}}</p>
                <div class="clearfix">
                    <div class="center">
                        <h3 class="price">{{$product->price}}€</h3>
                        <a href="{{ route('product.addToWishlist', $product->id)}}" class="btn btn-primary wishlist"><i class="fas fa-heart"></i> Add to wishlist</a>
                        <a href="{{ route('product.addToCart', $product->id)}}" class="btn btn-success  cart"><i class="fas fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div>
            </div>
        </div> 
    </div>    
    @endforeach
</div>    
@empty
    <h6 class="text-center">No products</h6>
@endforelse       
@endsection  
