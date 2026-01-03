<style>
    /* Sets the background for the entire page with a pink gradient */
    body {
        background: linear-gradient(135deg, #ffe6f0 0%, #ffeee9 100%) !important;
    }

    /* Product card styling: adds a hover animation and pointer cursor */
    .product-card {
        cursor: pointer;
        /* Changes cursor to a pointer on hover */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* Smooth transition for animation */
    }

    /* When the user hovers over a product card */
    .product-card:hover {
        transform: translateY(-5px);
        /* Moves the card slightly upward */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        /* Adds a soft shadow for a lift effect */
    }

    /* View Details button styling — currently hidden by default */
    .btn-view-details {
        background-color: #8e194a !important;
        /* Dark pink color */
        color: #fff !important;
        /* White text */
        border-radius: 12px;
        /* Rounded corners */
        padding: 8px 16px;
        /* Internal spacing */
        font-weight: bold;
        /* Bold text */
        transition: background-color 0.3s ease;
        /* Smooth color change on hover */
        display: none;
        /* Hides this button for now */
    }

    /* Changes button color on hover */
    .btn-view-details:hover {
        background-color: #f4a4be !important;
        /* Lighter pink when hovered */
    }

    /* Ensures product images look consistent and nicely rounded */
    .product-card img {
        width: 100%;
        /* Makes image fill the card width */
        height: auto;
        /* Keeps image ratio */
        border-radius: 15px;
        /* Softly rounded corners */
    }

    /* Adjust spacing for smaller screens (responsive design) */
    @media (max-width: 768px) {
        .product-card {
            margin-bottom: 20px;
            /* Adds extra spacing between products on mobile */
        }
    }

    /* Sets the main heading color */
    h1 {
        color: #950f52 !important;
        /* Deep pink/purple */
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

        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card p-3 shadow-sm border-0 bg-white">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-4">
                            <label for="categoryFilter" class="form-label fw-bold d-block">Filter by Category:</label>
                            <select id="categoryFilter" class="form-select">
                                <option value="all">All Categories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8 position-relative">
                            <label for="searchInput" class="form-label fw-bold">Search:</label>
                            <input type="text" id="searchInput" class="form-control"
                                placeholder="Search products by name...">
                            <div id="searchResults" class="list-group position-absolute w-100 shadow mt-1"
                                style="z-index: 1000; display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="productList">
            {{-- This row holds all product cards in a grid format --}}
            @foreach ($products as $product)
                {{-- Loops through each product in the $products array or collection --}}

                <div class="col-md-4 mb-4" data-category="{{ $product->category_id }}">
                    {{-- Each product occupies one-third of the row on medium and larger screens --}}

                    <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark">
                        {{-- Clicking the product leads to its details page using its ID --}}
                        {{-- The text-decoration-none removes underlines, and text-dark keeps text black --}}

                        <div class="card border-0 shadow-sm h-100 text-center product-card">
                            {{-- Bootstrap card with no borders, light shadow, full height, and centered text --}}
                            @if($product->image)
                                <img src="{{ asset('images/' . $product->image) }}" class="card-img-top"
                                    style="max-height:400px; object-fit: cover;" alt="{{ $product->title }}">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                    style="height: 400px;">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif
                            {{-- Loads the product image from the images folder with a height limit of 400px --}}

                            <div class="card-body">
                                {{-- Contains the product title, description, and price --}}
                                <h5 class="card-title fw-bold text-dark">{{ $product->title }}</h5>
                                <p class="text-muted small mb-1">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                <p class="text-muted small">{{ $product->short }}</p>
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
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const searchResults = document.getElementById('searchResults');

        // Function to perform search and display results
        function fetchProducts() {
            const query = searchInput.value;
            const category = categoryFilter.value;

            // If search is empty, handle client-side filtering for the grid only
            if (query.trim() === '') {
                searchResults.style.display = 'none';

                // Show grid items based on category
                document.querySelectorAll('.col-md-4[data-category]').forEach(productContainer => {
                    const cat = productContainer.getAttribute('data-category');
                    if (category === 'all' || cat === category) {
                        productContainer.style.display = 'block';
                    } else {
                        productContainer.style.display = 'none';
                    }
                });
                return;
            }

            // AJAX request for search
            fetch(`{{ route('products.search') }}?search=${encodeURIComponent(query)}&category=${encodeURIComponent(category)}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(product => {
                            const item = document.createElement('a');
                            item.href = `/product/${product.id}`;
                            item.className = 'list-group-item list-group-item-action d-flex align-items-center p-2';

                            let imgHtml = '';
                            if (product.image) {
                                imgHtml = `<img src="/images/${product.image}" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">`;
                            } else {
                                imgHtml = `<div class="rounded me-3 d-flex align-items-center justify-content-center bg-light" style="width: 50px; height: 50px;"><small class="text-muted" style="font-size: 10px;">No Img</small></div>`;
                            }

                            item.innerHTML = `
                                        ${imgHtml}
                                        <div>
                                            <div class="fw-bold text-dark">${product.title}</div>
                                            <small class="text-muted">Rs ${parseFloat(product.price).toFixed(2)}</small>
                                        </div>
                                    `;
                            searchResults.appendChild(item);
                        });
                        searchResults.style.display = 'block';
                    } else {
                        searchResults.innerHTML = '<div class="list-group-item text-muted">No products found</div>';
                        searchResults.style.display = 'block';
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Event listeners
        searchInput.addEventListener('keyup', fetchProducts);
        categoryFilter.addEventListener('change', fetchProducts);

        // Hide dropdown when clicking outside
        document.addEventListener('click', function (e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });
    </script>

@endsection
{{-- Ends the "content" section --}}