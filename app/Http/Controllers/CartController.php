<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Service\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, CartService $cartService, Product $product)
    {
        $cartService->add($product, $request->quantity);
        
        return response()->json([
            'success' => 'Cart was added succesfully'
        ]);
    }

    public function removeAll(CartService $cartService)
    {
        $cartService->removeAll();

        return response()->json([
            'success' => 'Cart is empty'
        ]);
    }

    public function removeItem(CartService $cartService, int $productId)
    {
        $cartService->removeItem($productId);

        return response()->json([
            'success' => 'Item is removed'    
        ]);
    }

    public function addQuantity(CartService $cartService, int $cartId)
    {
        $cartService->addQuantity($cartId);

        return response()->json([
            'success' => 'Item quantity is added'    
        ]);
    }

    public function removeQuantity(CartService $cartService, int $cartId)
    {
        $cartService->removeItem($cartId);

        return response()->json([
            'success' => 'Item quantity is removed'    
        ]);
    }


}
