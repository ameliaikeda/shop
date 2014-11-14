<?php namespace Amelia\Shop\Http\Controllers;

use Amelia\Shop\Services\Cart\CartService;
use Illuminate\Routing\Controller;

class CartController extends Controller {


    /**
     * Initialise the controller with a cart instance
     *
     * @param \Amelia\Shop\Services\Cart\CartService $cart
     */
    public function __construct(CartService $cart) {
        // cart here is the same class as the cart facade.
        $this->cart = $cart;
    }

    public function add(AddToCartRequest $request) {
        $this->cart->add($request->get("id"), $request->get("options"));
    }
}