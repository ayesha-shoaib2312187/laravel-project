<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = $request->user()->orders()->orderBy('date', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
        ]);

        $grandTotal = 0;
        foreach ($request->items as $item) {
            $product = \App\Models\Product::find($item['product_id']);
            $grandTotal += $product->price * $item['quantity'];
        }

        $order = $request->user()->orders()->create([
            'order_number' => 'ORD-API-' . strtoupper(uniqid()),
            'customer_name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'total' => $grandTotal,
            'status' => 'Pending',
            'date' => now(),
        ]);

        foreach ($request->items as $item) {
            $product = \App\Models\Product::find($item['product_id']);
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => $order->load('items')
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $order = $request->user()->orders()->with('items.product')->find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ]);
    }
}
