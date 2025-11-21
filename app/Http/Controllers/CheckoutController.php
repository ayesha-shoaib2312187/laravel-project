<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Show checkout page
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }

        // Calculate grand total
        $grandTotal = 0;
        foreach ($cart as $item) {
            $grandTotal += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
        }

        return view('checkout', compact('cart', 'grandTotal'));
    }

    // Handle checkout form submission
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
        ]);

        // 🧶 Optional: save order details to database (future feature)

        // Clear the cart after successful checkout
        session()->forget('cart');

        // Redirect to thank-you page with a success message
        return redirect()->route('thankyou')->with('success', 'Your order has been placed successfully!');
    }
}
