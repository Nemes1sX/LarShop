<?php

namespace App\Http\Composers;

use App\Service\CartService;
use Illuminate\View\View;

class HeaderComposer {

    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function compose(View $view) {
        $cart = $this->cartService->index();

        $quantities = array_column($cart, 'quantity') ?? [];
        $totalQuantity = array_sum($quantities) ?? 0;

        $view->with('totalQuantity', $totalQuantity);
    }
}