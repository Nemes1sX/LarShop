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
            $stripe = new StripeClient(config('stripe.secret_key'));

            $totalPrice = array_sum(array_map(function ($item) {
                return $item['quantity'] * floatval($item['price']);
            }, $cart));

            $order = Order::create($request->validated());

            foreach ($cart as $item) {
                $order->orderLines()->create([
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            $metadata = [
                'order_id' => (string) $order->id,
                'order_status' => (string) $order->status->value,
                'fullname' => (string) $order->fullname,
                'email' => (string) $order->email,
                'postcode' => (string) $order->postcode,
                'address' => (string) $order->address,
                'city' => (string) $order->city,
            ];

            $response = $stripe->checkout->sessions->create([
                'success_url' => route('order.callback.success'),
                'cancel_url' => route('order.callback.failed'),
                'metadata' => $metadata,
                'payment_intent_data' => [
                    'metadata' => $metadata,
                ],
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

    public function callbackSuccess(CartService $cartService)
    {
        $cartService->removeAll();

        return view('order.success');
    }

    public function callbackFailed()
    {
        return 'Order failed';
    }

}
