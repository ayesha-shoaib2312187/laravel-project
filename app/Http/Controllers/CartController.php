<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product; // ← import your Product model

class CartController extends Controller
{
    // Show cart page
    public function index()
    {
        $cart = Session::get('cart', []);
        $grandTotal = 0;

        foreach ($cart as $item) {
            $grandTotal += ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
        }

        return view('cart', compact('cart', 'grandTotal'));
    }

    // Add product to cart
    public function add(Request $request, $id)
    {
        // Fetch product from database
        $product = Product::findOrFail($id);

        $cart = Session::get('cart', []);

        $quantity = $request->quantity ?? 1;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'title' => $product->title,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Update quantity
    public function update(Request $request, $id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $quantity = max(1, (int)$request->quantity);
            $cart[$id]['quantity'] = $quantity;
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    // Decrement quantity by 1
    public function decrement($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] -= 1;
            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    // Remove product
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed!');
    }

    // Clear entire cart
    public function clear()
    {
        Session::forget('cart');
        return redirect()->back()->with('success', 'Cart cleared!');
    }
}
