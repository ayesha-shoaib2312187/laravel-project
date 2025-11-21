<style>
    /* Sets the background for the entire page with a pink gradient */
    body {
        background: linear-gradient(135deg, #ffe6f0 0%, #ffeee9 100%) !important;
    }

    /* Product card styling: adds a hover animation and pointer cursor */
    .product-card {
        cursor: pointer; /* Changes cursor to a pointer on hover */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for animation */
    }

    /* When the user hovers over a product card */
    .product-card:hover {
        transform: translateY(-5px); /* Moves the card slightly upward */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Adds a soft shadow for a lift effect */
    }

    /* View Details button styling — currently hidden by default */
    .btn-view-details {
        background-color: #8e194a !important; /* Dark pink color */
        color: #fff !important; /* White text */
        border-radius: 12px; /* Rounded corners */
        padding: 8px 16px; /* Internal spacing */
        font-weight: bold; /* Bold text */
        transition: background-color 0.3s ease; /* Smooth color change on hover */
        display: none; /* Hides this button for now */
    }

    /* Changes button color on hover */
    .btn-view-details:hover {
        background-color: #f4a4be !important; /* Lighter pink when hovered */
    }

    /* Ensures product images look consistent and nicely rounded */
    .product-card img {
        width: 100%; /* Makes image fill the card width */
        height: auto; /* Keeps image ratio */
        border-radius: 15px; /* Softly rounded corners */
    }

    /* Adjust spacing for smaller screens (responsive design) */
    @media (max-width: 768px) {
        .product-card {
            margin-bottom: 20px; /* Adds extra spacing between products on mobile */
        }
    }

    /* Sets the main heading color */
    h1 {
        color: #950f52 !important; /* Deep pink/purple */
    }
</style>

{{-- Extends the base layout file --}}
@extends('layouts.layout')

{{-- Everything between @section and @endsection goes inside the "content" area of the main layout --}}
@section('content')

    <div class="container py-5">
        {{-- Adds a centered container with vertical padding for spacing --}}

        <h1 class="text-center mb-4 fw-bold text-pink">Our Collection</h1>
        {{-- Displays the main heading at the top of the page --}}

        <div class="text-center mb-4">
            {{-- Section for the product category filter dropdown --}}
            <label for="categoryFilter" class="form-label fw-bold">Filter by Category:</label>
            {{-- Label for the dropdown menu --}}

            <select id="categoryFilter" class="form-select w-auto d-inline-block">
                {{-- Dropdown list for filtering products by category --}}
                <option value="all">All</option>
                <option value="Flowers">Flowers</option>
                <option value="toys">Toys</option>
                <option value="bags">Bags</option>
                <option value="blankets">Blankets</option>
                <option value="cardigan">Cardigan</option>
                <option value="beanies">Beanies</option>
                <option value="keychains">Keychains</option>
            </select>
        </div>

        <div class="row" id="productList">
            {{-- This row holds all product cards in a grid format --}}
            @foreach ($products as $product)
                {{-- Loops through each product in the $products array or collection --}}

                <div class="col-md-4 mb-4" data-category="{{ $product->category }}">
                    {{-- Each product occupies one-third of the row on medium and larger screens --}}

                    <a href="{{ route('product.show', $product->id) }}"
                       class="text-decoration-none text-dark">
                        {{-- Clicking the product leads to its details page using its ID --}}
                        {{-- The text-decoration-none removes underlines, and text-dark keeps text black --}}

                        <div class="card border-0 shadow-sm h-100 text-center product-card">
                            {{-- Bootstrap card with no borders, light shadow, full height, and centered text --}}
                            @if($product->image)
                                <img src="{{ asset('images/' . $product->image) }}"
                                     class="card-img-top"
                                     style="max-height:400px; object-fit: cover;"
                                     alt="{{ $product->title }}">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 400px;">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif
                            {{-- Loads the product image from the images folder with a height limit of 400px --}}

                            <div class="card-body">
                                {{-- Contains the product title, description, and price --}}
                                <h5 class="card-title fw-bold text-dark">{{ $product->title }}</h5>
                                {{-- Displays the product name in bold --}}
                                <p class="text-muted small">{{ $product->short }}</p>
                                {{-- Shows a short description in lighter gray text --}}
                                <p class="fw-semibold mb-2">Rs {{ number_format($product->price, 2) }}</p>
                                {{-- Displays the product price in bold with a small margin below --}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            {{-- Ends the foreach loop --}}
        </div>
    </div>

    <script>
        // Adds an event listener to detect when the user changes the filter dropdown
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const selected = this.value; // Stores the selected category

            // Goes through each product container on the page
            document.querySelectorAll('.col-md-4[data-category]').forEach(productContainer => {
                // Reads the product's category from the data-category attribute
                const category = productContainer.getAttribute('data-category');

                // If "All" is selected, show all products.
                // Otherwise, show only the ones matching the selected category.
                if (selected === 'all' || category === selected) {
                    productContainer.style.display = 'block';
                } else {
                    productContainer.style.display = 'none';
                }
            });
        });
    </script>

@endsection
{{-- Ends the "content" section --}}
