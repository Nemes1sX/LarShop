<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Service\CartService;
use Illuminate\Http\Request;
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

         $response = $stripe->checkout->sessions->create([
            'success_url' => route('order.callback.success', $order),
            'failed_url' => route('order.callback.failed', $order),
            'metadata' => $order,
            "amount_total" => $totalPrice,
            'mode' => 'payment',
          ]);

          redirect($response->url);
    }

    public function callbackSucesssOrder(Order $order)
    {
        $order->update([
            'status' => OrderStatus::Complete
        ]);
        
        return redirect()->route('order.success');
    }

    public function callbackFailedOrder(Order $order)
    {
        $order->update([
            'status' => OrderStatus::Failed
        ]);

        return 'Order failed';
    }

    public function test()
    {
        phpinfo();
    }
}
