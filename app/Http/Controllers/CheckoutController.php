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

        $cart = session('cart', []);
        $grandTotal = 0;
        foreach ($cart as $item) {
            $grandTotal += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
        }

        // Create the order
        $order = \App\Models\Order::create([
            'user_id' => auth()->id(), // Nullable if guest
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'customer_name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'total' => $grandTotal,
            'status' => 'Pending',
            'date' => now(),
        ]);

        // Save order items
        foreach ($cart as $id => $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear the cart after successful checkout
        session()->forget('cart');

        // Redirect to thank-you page with a success message
        return redirect()->route('thankyou')->with('success', 'Your order has been placed successfully!');
    }
}
