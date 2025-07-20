<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Service\CartService;
use Illuminate\Support\Facades\Log;
use stdClass;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request, CartService $cartService)
    {
        $cart = $cartService->index();

        try {
            $stripe = new StripeClient(env('STRIPE_SECRET'));

            $totalPrice = array_sum(array_map(function ($item) {
                return $item['quantity'] * floatval($item['price']);
            }, $cart));

            $order = Order::create($request->validated());

            $metadata = [
                'order_id' => $order->id,
                'order_status' => $order->status->value,
                'fullname' => $order->fullname,
                'email' => $order->email,
                'postcode' => $order->postcode,
                'address' => $order->address,
                'city' => $order->city,
            ];

            $response = $stripe->checkout->sessions->create([
                'success_url' => route('order.callback.success'),
                'cancel_url' => route('order.callback.cancel'),
                'metadata' => $metadata,
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'EUR',
                            'unit_amount' => $totalPrice * 100,
                            'product_data' => [
                                'name' => 'No.' . $order->id
                            ]
                        ],
                        'quantity' => 1
                    ]
                ],
                'mode' => 'payment',
            ]);

            return redirect($response->url);
        } catch (ApiErrorException $e) {
            Log::error('Log error:'. $e->getMessage());
            return redirect()->route('order.callback.failed')->with('error', $e->getMessage());
        }
    }

    public function callbackSuccesssOrder(CartService $cartService)
    {
        $cartService->removeAll();

        return view('order.success');
    }

    public function callbackFailedOrder()
    {
        return 'Order failed';
    }

}
