@extends('layouts.layout')
@section('content')
<div class="row">
    <div class="col-sm-4 col-md-6 col-lg-4">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top img-thumbanil" src="https://img.thewhiskyexchange.com/900/rum_cap2.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <div class="clearfix">
                    <div class="pull-center"><h6>5e</h6></div> 
                    <a href="#" class="btn btn-primary pull-right">Add To Wishlist</a>
                    <a href="#" class="btn btn-success pull-right">Add To Cart</a>
                </div>
        </div>
    </div>
   </div> 
    <div class="col-sm-4 col-md-6 col-lg-4">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4 col-md-6 col-lg-4">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</div>            
@endsection