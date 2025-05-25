<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Service\CartService;
use Stripe\StripeClient;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request, CartService $cartService)
    {
        $cart = $cartService->index();

         $stripe = new StripeClient(env('STRIPE_SECRET'));

         $totalPrice = array_sum(array_map(function ($item ) { 
            return $item['quantity'] * floatval($item['price']);
         }, $cart)); 

         $order = Order::create($request->validated());

         $metadata = [
            'order_id' => $order->id,
            'order_status' => $order->status->value
        ];

         $response = $stripe->checkout->sessions->create([
            'success_url' => route('order.callback.success', $order),
            'metadata' => $metadata,
            'line_items'  => [
                [
                'price_data' => [ 
                  'currency' => 'EUR',
                  'unit_amount' =>  $totalPrice * 100,
                  'product_data' => [
                    'name' => 'No.'. $order->id
                  ]
                  ],
                'quantity' => 1  
                ]   
            ],
            'mode' => 'payment',
            'payment_intent_data' => [
                'metadata' => $metadata
            ]
          ]);

        return redirect($response->url);
    }

    public function callbackSuccesssOrder(Order $order, CartService $cartService)
    {
        $order->update([
            'status' => OrderStatus::Complete
        ]);
        
        $cartService->removeAll();

        return view('order.success');
    }

    public function callbackFailedOrder(Order $order)
    {
        $order->update([
            'status' => OrderStatus::Failed
        ]);

        return view('order.failed');
    }

}
