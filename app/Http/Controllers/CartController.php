<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Interfaces\CartManagement;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    private CartManagement $cartManagement;

    public function __construct(CartManagement $cartManagement)
    {
        $this->cartManagement = $cartManagement;
    }

    public function add(AddToCartRequest $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $quantity = $request->validated()['quantity'];

        $cart = session('cart', []);
        $cart = $this->cartManagement->addToCart($cart, $product->getId(), $quantity, $product->getStock());
        session(['cart' => $cart]);

        return redirect()->route('product.show', ['id' => $id])->with('success', __('product.addedToCart'));
    }

    public function remove(string $id): RedirectResponse
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);

        return redirect()->route('order.checkout');
    }
}
