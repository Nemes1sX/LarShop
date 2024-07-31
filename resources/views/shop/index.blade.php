@extends('layouts.layout')
@section('content')
<div class="row">
<section id="billboard" class="position-relative overflow-hidden bg-light-blue">
      <div class="swiper main-swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="container">
              <div class="row d-flex align-items-center">
                <div class="col-md-6">
                  <div class="banner-content">
                    <h1 class="display-2 text-uppercase text-dark pb-5">Your Products Are Great.</h1>
                    <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Product</a>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="image-holder">
                    <img src="{{ asset('img/banner-image.png') }}" alt="banner">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="container">
              <div class="row d-flex flex-wrap align-items-center">
                <div class="col-md-6">
                  <div class="banner-content">
                    <h1 class="display-2 text-uppercase text-dark pb-5">Technology Hack You Won't Get</h1>
                    <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Product</a>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="image-holder">
                    <img src="{{ asset('img/banner-image.png') }}" alt="banner">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-icon swiper-arrow swiper-arrow-prev">
        <svg class="chevron-left">
          <use xlink:href="#chevron-left" />
        </svg>
      </div>
      <div class="swiper-icon swiper-arrow swiper-arrow-next">
        <svg class="chevron-right">
          <use xlink:href="#chevron-right" />
        </svg>
      </div>
    </section>
    <section id="company-services" class="padding-large">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box d-flex">
              <div class="icon-box-icon pe-3 pb-3">
                <svg class="cart-outline">
                  <use xlink:href="#cart-outline" />
                </svg>
              </div>
              <div class="icon-box-content">
                <h3 class="card-title text-uppercase text-dark">Free delivery</h3>
                <p>Consectetur adipi elit lorem ipsum dolor sit amet.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box d-flex">
              <div class="icon-box-icon pe-3 pb-3">
                <svg class="quality">
                  <use xlink:href="#quality" />
                </svg>
              </div>
              <div class="icon-box-content">
                <h3 class="card-title text-uppercase text-dark">Quality guarantee</h3>
                <p>Dolor sit amet orem ipsu mcons ectetur adipi elit.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box d-flex">
              <div class="icon-box-icon pe-3 pb-3">
                <svg class="price-tag">
                  <use xlink:href="#price-tag" />
                </svg>
              </div>
              <div class="icon-box-content">
                <h3 class="card-title text-uppercase text-dark">Daily offers</h3>
                <p>Amet consectetur adipi elit loreme ipsum dolor sit.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box d-flex">
              <div class="icon-box-icon pe-3 pb-3">
                <svg class="shield-plus">
                  <use xlink:href="#shield-plus" />
                </svg>
              </div>
              <div class="icon-box-content">
                <h3 class="card-title text-uppercase text-dark">100% secure payment</h3>
                <p>Rem Lopsum dolor sit amet, consectetur adipi elit.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<div class="row">
        @forelse($products->take(4) as $product)
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ $product->imagePath }}" class="img-thumbnail rounded mx-auto d-block" alt="{{ $product->title }}" width="150" height="150">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $product->title }}</h5>
                        <p class="card-text text-center">{{ $product->price  }} €</p>
                    </div>
                    <span class="text-center">
              <select>
                @for($i = 1; $i<=5; $i++)
                  <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
              <a class="btn btn-success" href="{{route ('product.addToCart', $product)}}">Add to cart</a>
              </span>
                </div>
            </div>
        @empty
          <h5 class="text-center">No products</h5>
        @endforelse
    </div>
<section id="mobile-products" class="product-store position-relative padding-large no-padding-top">
<div class="swiper product-swiper">
  <div class="swiper-wrapper">
    @forelse($products->take(4) as $product)
      <div class="swiper-slide">
        <div class="product-card position-relative">
          <div class="image-holder">
            <img src="{{$product->imagePath}}" alt="{{$product->title}}" class="img-thumbnail">
          </div>
          <div class="cart-concern position-absolute">
            <div class="cart-button d-flex">
              <a href="{{ route('product.addToCart', $product->id) }}" class="btn btn-medium btn-black">
                Add to Cart
                <svg class="cart-outline">
                  <use xlink:href="#cart-outline"></use>
                </svg>
              </a>
            </div>
          </div>
          <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
            <h3 class="card-title text-uppercase">
              <a href="#">{{$product->title}}</a>
            </h3>
            <span class="item-price text-primary">{{$product->price}}</span>
  
          </div>
        </div>
      </div>
    @empty
      <h6 class="text-center">No products</h6>
    @endforelse
  </div>
</div>  
</section>
</div>           
@endsection  
