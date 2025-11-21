@extends('layouts.layout')
{{-- This line tells Laravel to use the main layout file (layouts/layout.blade.php) as the base structure for this page. --}}

@section('content')
    {{-- Everything between @section and @endsection will be injected into the "content" area of the layout. --}}

    <div class="container text-center py-5" style="background-color: #fff0f5; border-radius: 20px;">
        {{-- Main container with centered content and soft pink background.
             - text-center: centers text horizontally
             - py-5: adds vertical padding
             - inline style adds light pink background and rounded corners. --}}

        <div class="py-5">
            {{-- Adds vertical padding around the content inside the container for spacing. --}}

            <h1 class="text-pink fw-bold mb-4">Thank You for Shopping!</h1>
            {{-- Heading that shows a thank-you message.
                 - text-pink: custom pink text color (defined in CSS below)
                 - fw-bold: bold text
                 - mb-4: bottom margin for spacing. --}}

            <p class="fs-5 text-muted mb-4">
                Your order has been placed successfully. We’ll start crocheting your happiness right away!
            </p>
            {{-- Paragraph describing a confirmation message in a friendly tone.
                 - fs-5: slightly larger font size
                 - text-muted: gray color for softer appearance
                 - mb-4: bottom margin for spacing. --}}

            <div class="mt-4">
                {{-- Wrapper for the buttons, adds top margin to separate from the text above. --}}

                <a href="{{ route('products') }}" class="btn btn-outline-pink me-2">🛍️ Continue Shopping</a>
                {{-- Button linking to the products page.
                     - btn-outline-pink: outlined pink button (custom class defined in CSS)
                     - me-2: adds right margin
                     - emoji adds a playful shopping icon. --}}

                <a href="{{ route('home') }}" class="btn btn-pink">🏠 Back to Home</a>
                {{-- Button linking back to the home page.
                     - btn-pink: solid pink button (custom class)
                     - emoji adds a home icon for clarity. --}}
            </div>
        </div>
    </div>

    <style>
        /* Custom CSS styles for buttons and text used on this page */

        .text-pink {
            color: #8e194a !important; /* Dark pink color for headings */
        }

        .btn-pink {
            background-color: #950f52; /* Deep pink background */
            color: #fff; /* White text */
            border-radius: 12px; /* Rounded corners */
            transition: all 0.3s ease; /* Smooth hover animation */
        }

        .btn-pink:hover {
            background-color: #ff4da6; /* Lighter pink when hovered */
            transform: scale(1.05); /* Slight zoom-in effect */
        }

        .btn-outline-pink {
            border: 2px solid #ff85c0; /* Pink border outline */
            color: #8e194a; /* Dark pink text */
            border-radius: 12px; /* Rounded corners */
            transition: all 0.3s ease; /* Smooth color change on hover */
        }

        .btn-outline-pink:hover {
            background-color: #ff85c0; /* Fills with pink color when hovered */
            color: #fff; /* Changes text to white */
            transform: scale(1.05); /* Slight zoom-in on hover */
        }
    </style>
@endsection
{{-- Ends the content section. Everything above this line will appear inside the main layout. --}}
