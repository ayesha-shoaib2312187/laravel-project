@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-pink">Order Details: {{ $order->order_number }}</h1>
            <a href="{{ route('user.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-bold">Items</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            @if($item->product)
                                                {{ $item->product->title }}
                                            @else
                                                <span class="text-muted">Product Deleted</span>
                                            @endif
                                        </td>
                                        <td>Rs {{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rs {{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Grand Total:</th>
                                    <th class="fw-bold">Rs {{ number_format($order->total, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-bold">Order Info</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                        <p><strong>Status:</strong> <span class="badge bg-secondary">{{ $order->status }}</span></p>
                        <hr>
                        <p><strong>Shipping Address:</strong><br>
                            {{ $order->customer_name }}<br>
                            {{ $order->address }}<br>
                            {{ $order->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-pink {
            color: #950f52 !important;
        }
    </style>
@endsection