@extends('layouts.layout')
@section('content')
@foreach($products->chunk(3) as $productChunk)
<div class="row">
    @foreach($productChunk as $product)
    <div class="col-sm-4 col-md-6 col-lg-4">
        <div class="thumbnail" style="width: 18rem;">
            <img class="card-img-top thumbnail" src="{{$product->imagePath}}" alt="Card image cap">
            <div class="caption">
                <h5 class="card-title">{{$product->title}}</h5>
                <p class="card-text">Kategorija: {{$product->category}}</p>
                <p class="card-text">{{$product->description}}</p>
                <div class="clearfix">
                    <div class="pull-left price">{{$product->price}}</div> 
                    <a href="#" class="btn btn-primary pull-right">Įdėti į Wishlist</a>
                    <a href="#" class="btn btn-success pull-right">Pridėti į krepšelį</a>
                </div>
            </div>
            @endforeach
        </div>
       @endforeach 
   </div> 
    <!--<div class="col-sm-4 col-md-6 col-lg-4">
        <div class="thumbnail" style="width: 18rem;">
            <img class="card-img-top thumbnail" src="https://img.thewhiskyexchange.com/900/rum_cap2.jpg" alt="Card image cap">
            <div class="caption">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <div class="clearfix">
                    <div class="pull-left price">5.00$</div> 
                    <a href="#" class="btn btn-primary pull-right">Add To Wishlist</a>
                    <a href="#" class="btn btn-success pull-right">Add To Cart</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 col-md-6 col-lg-4">
        <div class="thumbnail" style="width: 18rem;">
            <img class="card-img-top thumbnail" src="https://img.thewhiskyexchange.com/900/rum_cap2.jpg" alt="Card image cap">
            <div class="caption">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <div class="clearfix">
                    <div class="pull-left price">5.00$</div> 
                    <a href="#" class="btn btn-primary pull-right">Add To Wishlist</a>
                    <a href="#" class="btn btn-success pull-right">Add To Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>-->       
@endsection