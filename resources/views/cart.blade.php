@extends('layouts.layout')
@section('content')
    <div></div>
    <div class="row">
        @forelse($cart as $item)
            <div class="col-md-12 offset-md-1 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0 font-weight-bold">{{ $item['name'] }}</h5>
                            <span class="text-success font-weight-bold h5 item-total-price">{{ $item['price'] * $item['quantity'] }}€</span>
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
                            <a href="{{ route('cart.remove', $item['id']) }}" class="btn btn-outline-danger btn-sm">Remove
                                item</a>
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
            <div class="col-md-8 offset-md-2 text-right mt-4">
                <h5>Total: <span class="text-success total-price">{{ $totalPrice }}€</span></h5>
                <div class="d-flex justify-content-end mt-2">
                    <button type="button" class="btn btn-success mr-2">Pay</button>
                    <a href="{{ route('cart.remove.all') }}" class="btn btn-danger">Remove cart</a>
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
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token for security
                    },
                    success: function(result) {
                        let cartCount = result.items;
                        let totalPrice = result.totalPrice;
                        let quantity = result.quantity;
                        let itemTotalPrice = result.itemTotalPrice;
                        vm.closest('.card').find('.item-total-price').text(itemTotalPrice + "€");
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
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token for security
                    },
                    success: function(result) {
                        let cartCount = result.items;
                        let totalPrice = result.totalPrice;
                        quantity = result.quantity;
                        let itemTotalPrice = result.itemTotalPrice;
                        console.log(itemTotalPrice);
                        vm.closest('.card').find('.item-total-price').text(itemTotalPrice  + "€"); 
                        vm.next().text(quantity);
                        $('.total-price').text(totalPrice + "€");
                        $('.cart-count').text(cartCount);
                    }
                });
            });
        });
    </script>
@endsection
