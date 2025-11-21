@extends('layouts.layout')

@section('content')
    <style>
        body {
            background-color: #fafafa;
        }

        .cart-container {
            max-width: 900px;
            margin: 60px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            padding: 40px 30px;
        }

        .cart-header {
            font-size: 1.8rem;
            font-weight: 700;
            color: #8e194a;
            margin-bottom: 25px;
            text-align: center;
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th {
            text-align: left;
            padding: 12px;
            background-color: #f9f9f9;
            font-weight: 600;
            color: #555;
            border-bottom: 2px solid #eee;
        }

        td {
            padding: 14px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f1f1;
        }

        td img {
            width: 70px;
            border-radius: 8px;
        }

        .quantity-input {
            width: 60px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 4px;
        }

        .btn-update, .btn-remove {
            border: none;
            border-radius: 6px;
            font-size: 14px;
            padding: 6px 14px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-update {
            background-color: #8e194a;
            color: #fff;
        }

        .btn-update:hover {
            background-color: #a83063;
        }

        .btn-remove {
            background-color: #fff;
            border: 1px solid #950f52;
            color: #950f52;
        }

        .btn-remove:hover {
            background-color: #c52974;
            color: #fff;
        }

        .cart-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #eee;
            font-size: 1.1rem;
        }

        .cart-total {
            font-weight: 700;
            color: #022b05;
        }

        .cart-actions {
            text-align: right;
            margin-top: 30px;
        }

        .btn-secondary, .btn-primary {
            border-radius: 6px;
            font-weight: 600;
            padding: 10px 20px;
            transition: background 0.3s ease;
        }

        .btn-secondary {
            border: 1px solid #ccc;
            color: #555;
            background: #fff;
        }

        .btn-secondary:hover {
            background: #ca1a55;
            color: white;
        }

        .btn-primary {
            background-color: #8e194a;
            border: none;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #a83063;
        }

        @media (max-width: 768px) {
            table thead {
                display: none;
            }

            table, table tbody, table tr, table td {
                display: block;
                width: 100%;
            }

            td {
                text-align: right;
                padding: 10px;
            }

            td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                color: #555;
            }

            .cart-summary {
                flex-direction: column;
                gap: 10px;
            }

            .cart-actions {
                text-align: center;
            }
        }
    </style>

    <div class="cart-container">
        <h2 class="cart-header">Your Shopping Cart</h2>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @if(empty($cart))
            <p class="text-center text-muted">Your cart is empty.</p>
        @else
            <table>
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cart as $id => $item)
                    <tr>
                        <td data-label="Product">{{ $item['title'] }}</td>

                        <td data-label="Image">
                            <img src="{{ asset('images/' . $item['image']) }}" alt="">
                        </td>

                        <td data-label="Qty">
                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" class="quantity-input"
                                       value="{{ $item['quantity'] }}" min="1">
                                <button type="submit" class="btn-update mt-2">Update</button>
                            </form>
                        </td>

                        <td data-label="Price">Rs {{ number_format($item['price']) }}</td>

                        <td data-label="Total">Rs {{ number_format($item['price'] * $item['quantity']) }}</td>

                        <td data-label="Action">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-remove">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="cart-summary">
                <span><strong>Grand Total:</strong></span>
                <span class="cart-total">Rs {{ number_format($grandTotal) }}</span>
            </div>

            <div class="cart-actions mt-4">
                <a href="{{ route('products') }}" class="btn btn-secondary me-2">← Continue Shopping</a>
                <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout →</a>
            </div>
        @endif
    </div>
@endsection
