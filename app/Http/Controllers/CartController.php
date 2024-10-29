<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Service\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(CartService $cartService)
    {
        $cart = $cartService->index() ?? [];
        $quantities = array_column($cart, 'quantity');
        $prices = array_column($cart, 'price');

        $totalQuantity = array_sum($quantities);
        $totalPrice = array_sum(array_map(function ($item ) { 
           return $item['quantity'] * floatval($item['price']);
        }, $cart)); 

        return view('cart', compact('cart','totalPrice', 'totalQuantity'));
    }

    public function add(Request $request, CartService $cartService, Product $product)
    {
        $cartService->add($product, $request->quantity);
        $cart = $cartService->index();

        $quantities = array_column($cart, 'quantity');
        $totalQuantity = array_sum($quantities);
        $totalPrice = array_sum(array_map(function ($item ) { 
            return $item['quantity'] * floatval($item['price']);
         }, $cart)); 
 

        return response()->json([
            'success' => 'Cart was added succesfully',
            'items' => $totalQuantity,
            'totalPrice' => $totalPrice   
        ]);
    }

    public function removeAll(CartService $cartService)
    {
        $cartService->removeAll();

        return redirect()->back();
        /*return response()->json([
            'success' => 'Cart is empty'
        ]);*/
    }

    public function remove(CartService $cartService, int $productId)
    {
        $cartService->removeItem($productId);

        return redirect()->back();
        /*return response()->json([
            'success' => 'Item is removed'    
        ]);*/
    }

    public function addQuantity(CartService $cartService, int $cartId)
    {
        $cartService->addQuantity($cartId);

        $cart = $cartService->index();
        $quantities = array_column($cart, 'quantity');

        $totalQuantity = array_sum($quantities);
        $totalPrice = array_sum(array_map(function ($item ) { 
           return $item['quantity'] * floatval($item['price']);
        }, $cart)); 


        return response()->json([
            'success' => 'Item quantity is added', 
            'quantity' => $cart[$cartId]['quantity'],
            'items' => $totalQuantity,
            'itemTotalPrice' => $cart[$cartId]['quantity'] * $cart[$cartId]['price'],
            'totalPrice' => $totalPrice 
        ]);
    }

    public function removeQuantity(CartService $cartService, int $cartId)
    {
        $cartService->removeQuantity($cartId);

        $cart = $cartService->index();
        $quantities = array_column($cart, 'quantity');

        $totalQuantity = array_sum($quantities);
        $totalPrice = array_sum(array_map(function ($item ) { 
           return $item['quantity'] * floatval($item['price']);
        }, $cart)); 

        return response()->json([
            'success' => 'Item quantity is removed',
            'quantity' => $cart[$cartId]['quantity'],
            'items' => $totalQuantity,
            'itemTotalPrice' => $cart[$cartId]['quantity'] * $cart[$cartId]['price'],
            'totalPrice' => $totalPrice    
        ]);
    }


}
