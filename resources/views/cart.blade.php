@extends('layouts.layout')
{{-- This tells Laravel to use the base layout file named "layout.blade.php" from the "layouts" folder.
     It ensures that the header, footer, and other common elements are consistent across pages. --}}

@section('content')
    {{-- This starts the “content” section, which will be inserted into @yield('content') inside the layout file. --}}

    <style>


        /* Sets the overall background color of the page to a light gray */
        body {
            background-color: #fafafa;
        }

        /* Main cart container box styling */
        .cart-container {
            max-width: 900px; /* Keeps the cart centered and not too wide */
            margin: 60px auto; /* Centers the cart vertically and horizontally */
            background: #fff; /* White background for contrast */
            border-radius: 12px; /* Rounded corners */
            box-shadow: 0 4px 15px rgba(0,0,0,0.08); /* Soft shadow for depth */
            padding: 40px 30px; /* Adds space inside the box */
        }

        /* Header text at the top of the cart page */
        .cart-header {
            font-size: 1.8rem;
            font-weight: 700;
            color: #8e194a; /* Pinkish color to match theme */
            margin-bottom: 25px;
            text-align: center;
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 15px;
        }

        /* Table styling for product list */
        table {
            width: 100%;
            border-collapse: collapse; /* Removes space between borders */
            margin-bottom: 30px;
        }

        /* Header row (titles like Product, Price, etc.) */
        th {
            text-align: left;
            padding: 12px;
            background-color: #f9f9f9;
            font-weight: 600;
            color: #555;
            border-bottom: 2px solid #eee;
        }

        /* Each data cell in the table */
        td {
            padding: 14px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f1f1;
        }

        /* Product images inside the table */
        td img {
            width: 70px;
            border-radius: 8px;
        }

        /* Input field to adjust product quantity */
        .quantity-input {
            width: 60px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 4px;
        }

        /* General button styling for update and remove buttons */
        .btn-update, .btn-remove {
            border: none;
            border-radius: 6px;
            font-size: 14px;
            padding: 6px 14px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        /* Update button color */
        .btn-update {
            background-color: #8e194a;
            color: #fff;
        }

        /* Hover effect for update button */
        .btn-update:hover {
            background-color: #a83063;
        }

        /* Remove button (outlined style) */
        .btn-remove {
            background-color: #fff;
            border: 1px solid #950f52;
            color: #950f52;
        }

        /* Hover effect for remove button */
        .btn-remove:hover {
            background-color: #c52974;
            color: #fff;
        }

        /* Cart summary (shows total) */
        .cart-summary {
            display: flex;
            justify-content: space-between; /* Text on left, total on right */
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #eee;
            font-size: 1.1rem;
        }

        /* Styling for total amount */
        .cart-total {
            font-weight: 700;
            color: #022b05;
        }

        /* Container for bottom buttons (checkout, continue shopping) */
        .cart-actions {
            text-align: right;
            margin-top: 30px;
        }

        /* Basic button styling for checkout and continue shopping */
        .btn-secondary, .btn-primary {
            border-radius: 6px;
            font-weight: 600;
            padding: 10px 20px;
            transition: background 0.3s ease;
        }

        /* Secondary button (continue shopping) */
        .btn-secondary {
            border: 1px solid #ccc;
            color: #555;
            background: #fff;
        }

        /* Hover effect for secondary button */
        .btn-secondary:hover {
            background: #ca1a55;
            color: white;
        }

        /* Primary button (checkout) */
        .btn-primary {
            background-color: #8e194a;
            border: none;
            color: #fff;
        }

        /* Hover effect for checkout button */
        .btn-primary:hover {
            background-color: #a83063;
        }

        /* ========== Responsive Design for Mobile ========== */
        @media (max-width: 768px) {
            /* Hide table headers on small screens */
            table thead {
                display: none;
            }

            /* Make table rows stack vertically */
            table, table tbody, table tr, table td {
                display: block;
                width: 100%;
            }

            /* Adjust cell text alignment */
            td {
                text-align: right;
                padding: 10px;
            }

            /* Add labels before each data item for clarity */
            td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                color: #555;
            }

            /* Stack the total and summary vertically */
            .cart-summary {
                flex-direction: column;
                gap: 10px;
            }

            /* Center the bottom buttons */
            .cart-actions {
                text-align: center;
            }
        }
    </style>

    {{-- ===================== MAIN CART CONTAINER ===================== --}}
    <div class="cart-container">
        <h2 class="cart-header">Your Shopping Cart</h2>
        {{-- Page title displayed above the cart table. --}}

        @if(session('success'))
            {{-- If a success message exists in session (like after update or removal), show it here. --}}
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @if(empty($cart))
            {{-- If the cart array is empty, display this message. --}}
            <p class="text-center text-muted">Your cart is empty.</p>
        @else
            {{-- Otherwise, display the cart table. --}}
            <table>
                <thead>
                {{-- Header row showing column titles --}}
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
                {{-- Loop through all items stored in the cart session --}}
                @foreach($cart as $id => $item)
                    <tr>
                        {{-- Product name --}}
                        <td data-label="Product">{{ $item['title'] }}</td>

                        {{-- Product image --}}
                        <td data-label="Image">
                            <img src="{{ asset('images/' . $item['image']) }}" alt="">
                        </td>

                        {{-- Quantity input with form to update quantity --}}
                        <td data-label="Qty">
                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf {{-- Protects from CSRF attacks --}}
                                <input type="number" name="quantity" class="quantity-input"
                                       value="{{ $item['quantity'] }}" min="1">
                                <button type="submit" class="btn-update mt-2">Update</button>
                            </form>
                        </td>

                        {{-- Product price --}}
                        <td data-label="Price">Rs {{ number_format($item['price']) }}</td>

                        {{-- Total price (price × quantity) --}}
                        <td data-label="Total">Rs {{ number_format($item['price'] * $item['quantity']) }}</td>

                        /*Remove item button */
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

            /* total cart summary */
            <div class="cart-summary">
                <span><strong>Grand Total:</strong></span>
                /*Displays total cost of all cart items */
                <span class="cart-total">Rs {{ number_format($grandTotal) }}</span>
            </div>

           /* actions button */
            <div class="cart-actions mt-4">
                /* Button to go back to the products page */
                <a href="{{ route('products') }}" class="btn btn-secondary me-2">← Continue Shopping</a>

                /*Button to go to the checkout page */
                <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout →</a>
            </div>
        @endif
    </div>
@endsection
{{-- Ends the content section. --}}
