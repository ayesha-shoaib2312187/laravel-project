@extends('layouts.layout')
{{-- This line extends the main layout file named "layout.blade.php" from the layouts folder --}}

@section('content')
    {{-- Everything between @section and @endsection will be inserted into the layout’s "content" section --}}

    <style>
        /* Add to Cart button styles */
        .btn-add-cart {
            background-color: #950f52 !important; /* Sets the background color of the button */
            color: #fff !important; /* Sets the text color to white */
            border-radius: 12px; /* Rounds the corners */
            padding: 8px 16px; /* Adds inner spacing */
            font-weight: bold; /* Makes the text bold */
            border: none; /* Removes the border */
            transition: background-color 0.3s ease; /* Smooth color transition on hover */
        }

        .btn-add-cart:hover {
            background-color: #f4a4be !important; /* Changes background when hovered */
            color: #fff !important; /* Keeps text color white */
        }

        /* Styles for individual review boxes */
        .review-box {
            border: 1px solid #eee; /* Adds a light border */
            border-radius: 10px; /* Rounds the box edges */
            padding: 15px; /* Adds inner spacing */
            margin-bottom: 10px; /* Adds space between reviews */
            background-color: #faf6f8; /* Sets a soft pinkish background */
        }

        /* Styles for the review form container */
        .review-form {
            background-color: #fff; /* Sets white background */
            border: 1px solid #ddd; /* Adds a subtle border */
            border-radius: 12px; /* Rounds corners */
            padding: 20px; /* Adds inner padding */
            margin-top: 20px; /* Adds space above the form */
            box-shadow: 0 2px 8px rgba(0,0,0,0.05); /* Adds a soft shadow */
        }

        /* Styles for the submit button inside the review form */
        .review-form button {
            background-color: #950f52; /* Sets dark pink background */
            color: #fff; /* Makes text white */
            border: none; /* Removes border */
            border-radius: 8px; /* Rounds corners */
            padding: 8px 20px; /* Adds spacing inside button */
            font-weight: bold; /* Makes text bold */
            transition: 0.3s ease; /* Smooth transition for hover effect */
        }

        .review-form button:hover {
            background-color: #f4a4be; /* Lightens the color on hover */
        }
    </style>

    <div class="container py-5">
        {{-- This container holds the entire product details section with padding on the top and bottom --}}

        <div class="row">
            {{-- This row divides the content into two columns: image and details --}}

            <div class="col-md-6 text-center">
                {{-- Left column: displays the product image, centered horizontally --}}
                @if($product->image)
                    <img src="{{ asset('images/' . $product->image) }}"
                         class="img-fluid rounded shadow-sm"
                         alt="{{ $product->title }}"
                         style="max-height: 400px; object-fit: cover;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded shadow-sm" style="height: 400px;">
                        <span class="text-muted">No Image Available</span>
                    </div>
                @endif
                {{-- The product image is loaded from the images folder, given a max height and smooth corners --}}
            </div>

            <div class="col-md-6">
                {{-- Right column: displays product title, description, price, and add-to-cart form --}}

                <h2 class="fw-bold">{{ $product->title }}</h2>
                {{-- Displays the product title in bold font --}}

                <p class="text-muted">{{ $product->desc }}</p>
                {{-- Shows the product description in a light gray color --}}

                <h4 class="text-success mb-3">PKR {{ number_format($product->price, 2) }}</h4>
                {{-- Displays the product price in green with some margin below --}}

                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-3">
                    {{-- Form for adding the product to the cart. Sends a POST request to the cart.add route --}}
                    @csrf
                    {{-- CSRF token for form security --}}

                    <label class="fw-semibold">Quantity:</label>
                    {{-- Label for quantity input field --}}

                    <input type="number" name="quantity" value="1" min="1" class="form-control w-auto d-inline-block">
                    {{-- Input box for selecting quantity, default is 1 and minimum allowed is 1 --}}

                    <button type="submit" class="btn-add-cart mt-2">Add to Cart</button>
                    {{-- Submit button styled with the .btn-add-cart class --}}
                </form>
            </div>
        </div>

        <hr class="my-5">
        {{-- Adds a horizontal line to separate product details from reviews, with vertical margins --}}

        <div class="mt-4">
            {{-- Section for customer reviews --}}

            <h4 class="fw-bold text-pink">Customer Reviews</h4>
            {{-- Heading for the reviews section --}}

            <div class="mt-3">
                {{-- Wrapper for all existing reviews --}}

                @forelse($reviews as $review)
                    {{-- Loops through each review from the database or array --}}
                    <div class="review-box">
                        {{-- Container for each individual review --}}
                        <strong>{{ $review['name'] }}</strong>
                        {{-- Displays the reviewer’s name in bold --}}
                        <p class="mb-0 text-muted">{{ $review['review'] }}</p>
                        {{-- Shows the actual review text in muted color --}}
                    </div>
                @empty
                    {{-- If there are no reviews yet, display this message --}}
                    <p class="text-muted">No reviews yet. Be the first to share your thoughts!</p>
                @endforelse
            </div>

            <div class="review-form mt-4">
                {{-- Review form for users to write and submit their own review --}}

                <h5 class="fw-semibold mb-3">Write a Review</h5>
                {{-- Heading for the review form --}}

                <form action="{{ route('product.review', $product->id) }}" method="POST">
                    {{-- The form sends a POST request to the product.review route with the product ID --}}
                    @csrf
                    {{-- Adds CSRF protection to prevent cross-site attacks --}}

                    <div class="mb-3">
                        {{-- Input field for user’s name --}}
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>

                    <div class="mb-3">
                        {{-- Textarea for the review message --}}
                        <textarea name="review" class="form-control" rows="3" placeholder="Write your review..." required></textarea>
                    </div>

                    <button type="submit">Submit Review</button>
                    {{-- Submit button to send the review --}}
                </form>
            </div>
        </div>
    </div>

@endsection
{{-- Ends the "content" section --}}
