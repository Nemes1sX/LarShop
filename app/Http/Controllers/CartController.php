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
}
