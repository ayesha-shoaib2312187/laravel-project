@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <h2 class="text-center text-pink mb-4">🧶 Checkout</h2>

        <div class="row">
            <!-- Left: Order Summary -->
            <div class="col-md-6">
                <div class="card p-3 shadow-sm">
                    <h5 class="text-pink mb-3">Order Summary</h5>
                    <ul class="list-group mb-3">
                        @foreach($cart as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item['title'] ?? 'Product' }} (x{{ $item['quantity'] ?? 1 }})
                                <span>Rs {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1)) }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <h5 class="text-end text-success">Total: Rs {{ number_format($grandTotal) }}</h5>
                </div>
            </div>

            <!-- Right: Checkout Form -->
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <h5 class="text-pink mb-3">Shipping Information</h5>

                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name ?? '' }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email ?? '' }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Delivery Address</label>
                            <textarea name="address" rows="3" class="form-control" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-pink w-100">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-pink {
            color: #d63384;
        }

        .btn-pink {
            background-color: #ff85c0;
            color: #fff;
            border-radius: 10px;
        }

        .btn-pink:hover {
            background-color: #ff4da6;
        }
    </style>
@endsection