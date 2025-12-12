<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Frolic Stitch')</title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 80px;
            /* Prevent navbar overlap */
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            /* Professional size */
            color: #C2185B !important;
            /* Professional Pink */
            letter-spacing: 0.5px;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            /* Cleaner weight */
            color: #4a4a4a;
            transition: color 0.3s ease;
            margin: 0 15px;
            /* Spacing between links */
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #C2185B;
            /* Professional Pink */
        }

        .btn-cart {
            background-color: #C2185B;
            /* Professional Pink */
            color: #fff;
            font-weight: 500;
            border-radius: 5px;
            /* Professional rounded corners */
            padding: 8px 20px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-cart:hover {
            background-color: #880E4F;
            /* Darker Rose */
            color: #fff;
        }

        .bg-pink {
            background-color: #880E4F !important;
        }

        /* Darker Rose for Footer */

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container-fluid px-lg-5">
            <!-- 1. Left: Brand -->
            <a class="navbar-brand" href="{{ route('home') }}">
                Frolic Stitch
            </a>

            <!-- Mobile toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- 2. Middle: Links (Centered) -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('home')) active @endif"
                            href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('products')) active @endif"
                            href="{{ route('products') }}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->routeIs('contact')) active @endif"
                            href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>

                <!-- 3. Right: Cart -->
                <div class="d-flex align-items-center">
                    <!-- Mobile Only Cart Link (inside collapse) -->
                    <a href="{{ route('cart') }}" class="nav-link d-lg-none mb-3">Cart</a>

                    <!-- Desktop Cart Button -->
                    <a href="{{ route('cart') }}" class="btn-cart d-none d-lg-block">
                        Cart
                    </a>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="bg-pink text-white py-5 mt-5">
        <div class="container text-center">
            <p class="mb-2">&copy; {{ date('Y') }} Frolic Stitch. All Rights Reserved.</p>
            <div>
                <a href="{{ route('home') }}" class="text-white mx-2 text-decoration-none">Home</a>
                <span class="text-white-50">|</span>
                <a href="{{ route('products') }}" class="text-white mx-2 text-decoration-none">Products</a>
                <span class="text-white-50">|</span>
                <a href="{{ route('contact') }}" class="text-white mx-2 text-decoration-none">Contact</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>