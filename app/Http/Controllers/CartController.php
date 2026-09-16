<?php

/**
 * @author Ana Sofía Angarita Barrios
 */

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public function add(AddToCartRequest $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $quantity = $request->validated()['quantity'];

        $cart = session('cart', []);
        $currentQuantity = $cart[$product->getId()] ?? 0;
        $cart[$product->getId()] = min($currentQuantity + $quantity, $product->getStock());
        session(['cart' => $cart]);

        return redirect()->route('product.show', ['id' => $id])->with('success', 'Product added to cart!');
    }

    public function remove(string $id): RedirectResponse
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);

        return redirect()->route('order.checkout');
    }
}
