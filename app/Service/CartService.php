<?php

namespace App\Service;

use App\Models\Product;

class CartService
{
    public function index()
    {
        return session()->get('cart') ?? null;
    }

    public function add(Product $product, int $quantity)
    {
        $cart = session()->get('cart');

        if (!$cart) {
            $this->newCart($product, $quantity);
            return;
        }
        if(isset($cart[$product->id])) {
            $this->updateQuantity($quantity);
            return;
        }

        
        $cart[$product->id] = [
            "name" => $product->name,
            "quantity" => $quantity,
            "price" => $product->price,
            "photo" => $product->photo
        ];

        session()->put('cart', $cart);
    }

    public function addQuantity(int $cartId)
    {
        $cart = session()->get('cart');

        $cart[$cartId]['quantity']++;

        session()->put('cart', $cart);
    }

    public function removeQuantity(int $cartId)
    {
        $cart = session()->get('cart');

        $cart[$cartId]['quantity']--;

        session()->put('cart', $cart);
    }

    public function removeAll()
    {
        session()->forget('cart');
    }

    public function removeItem(int $productId)
    {
        $cart = session()->get('cart');

        unset($cart[$productId]);

        session()->put('cart', $cart);
    }

    private function updateQuantity($cart, int $quantity)
    {
        $cart['id']['quantity']+=$quantity;
        session()->put('cart', $cart);
    }

    private function newCart(Product $product, $quantity)
    {
        $cart[$product->id] = [
            "name" => $product->name,
            "quantity" => $quantity,
            "price" => $product->price,
            "photo" => $product->photo
        ];

        session()->put('cart', $cart);
    }
}
