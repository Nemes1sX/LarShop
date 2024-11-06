@extends('layouts.layout')
@section('content')
    <div class="row mt-5">
        @forelse($cart as $item)
            <div class="col-md-12 mx-auto offset-md-1 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0 font-weight-bold">{{ $item['name'] }}</h5>
                            <span
                                class="text-success font-weight-bold h5 item-total-price">{{ $item['price'] * $item['quantity'] }}€</span>
                        </div>
                        <p class="card-text mb-3">
                            <span class="text-muted">Price per item:</span>
                            <span class="text-success font-weight-bold item-price">{{ $item['price'] }}€</span>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group" role="group" aria-label="Quantity controls">
                                <input type="hidden" class="product" value="{{ $item['id'] }}" />
                                <a href="#" class="btn btn-outline-secondary btn-sm remove-quantity">-</a>
                                <span class="btn btn-light btn-sm border quantity">{{ $item['quantity'] }}</span>
                                <a href="#" class="btn btn-outline-secondary btn-sm add-quantity">+</a>
                            </div>
                            <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">Remove item</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-8 offset-md-2 text-center">
                <strong class="text-muted">The cart is empty</strong>
            </div>
        @endforelse

        @if ($cart && count($cart) > 0)
            <div class="col-md-8 offset-md-2 text-right mt-4 d-flex">
                <p class="text-end fw-bold">Total price: {{ $totalPrice}} €</p>
                <div class="d-flex justify-content-between">
                  <button class="btn btn-danger mx-1">Remove cart</button>
                </div>
            </div>
            <div class="col-md-12 offset-md-2 text-right mx-auto mt-4">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('order.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full name</label>
                                <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                                    name="fullname" id="fullName">
                                @error('fullname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" id="address">
                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                    name="city" id="city">
                                @error('city')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="postCode" class="form-label">Post code</label>
                                <input type="text" class="form-control @error('postcode') is-invalid @enderror"
                                    name="postcode" id="postCode">
                                @error('postcode')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="terms" class="form-check-input @error('terms') is-invalid @enderror" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Accept service and terms </label>
                                @error('terms')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Pay</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script>
        $(document).ready(function() {
            $('.add-quantity').on('click', function(e) {
                e.preventDefault(); // Prevent default action of the button
                let product = $(this).closest('.card').find('.product').val();
                let vm = $(this);
                console.log(product);
                $.ajax({
                    type: 'POST',
                    url: `api/cart/add/quantity/${product}`,
                    datatype: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Add CSRF token for security
                    },
                    success: function(result) {
                        let cartCount = result.items;
                        let totalPrice = result.totalPrice;
                        let quantity = result.quantity;
                        let itemTotalPrice = result.itemTotalPrice;
                        vm.closest('.card').find('.item-total-price').text(itemTotalPrice +
                            "€");
                        vm.prev().text(quantity);
                        $('.total-price').text(totalPrice + "€");
                        $('.cart-count').text(cartCount);
                    }
                });
            });
            $('.remove-quantity').on('click', function(e) {
                let product = $(this).prev().val();
                let quantity = $(this).next().text();
                let vm = $(this);
                if (quantity <= 1) {
                    return;
                }
                $.ajax({
                    type: 'POST',
                    url: `api/cart/remove/quantity/${product}`,
                    datatype: 'JSON',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Add CSRF token for security
                    },
                    success: function(result) {
                        let cartCount = result.items;
                        let totalPrice = result.totalPrice;
                        quantity = result.quantity;
                        let itemTotalPrice = result.itemTotalPrice;
                        console.log(itemTotalPrice);
                        vm.closest('.card').find('.item-total-price').text(itemTotalPrice +
                            "€");
                        vm.next().text(quantity);
                        $('.total-price').text(totalPrice + "€");
                        $('.cart-count').text(cartCount);
                    }
                });
            });
        });
    </script>
@endsection
