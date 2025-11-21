<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Frolic Stitch')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .navbar-nav .nav-link {
            font-weight: 600;
            color: #6a1b9a;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #ba68c8;
        }

        .btn-cart {
            background-color: #fdfafc;
            color: #090909;
            font-weight: 600;
            border-radius: 20px;
            padding: 6px 16px;
            transition: background-color 0.3s ease;
        }
        .btn-cart:hover {
            color: #b32e6f;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: #8e1d52 !important;
            letter-spacing: 0.5px;
        }

        body {
            padding-top: 80px; /* Prevent navbar overlap */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            Frolic Stitch
        </a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item mx-2">
                    <a class="nav-link @if(request()->routeIs('home')) active @endif" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link @if(request()->routeIs('products')) active @endif" href="{{ route('products') }}">Shop</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link @if(request()->routeIs('contact')) active @endif" href="{{ route('contact') }}">Contact</a>
                </li>

                <li class="nav-item mx-2 d-lg-none">
                    <a class="nav-link" href="{{ route('cart') }}">🛒 Cart</a>
                </li>
            </ul>
        </div>

        <div class="d-none d-lg-block">
            <a href="{{ route('cart') }}" class="btn btn-cart">🛒 Cart</a>
        </div>
    </div>
</nav>

@yield('content')

<footer class="bg-pink text-white py-4 mt-5">
    <div class="container text-center">
        <p>&copy; {{ date('Y') }} Frolic Stitch. All Rights Reserved.</p>
        <p>
            <a href="{{ route('home') }}" class="text-white mx-2">Home</a> |
            <a href="{{ route('products') }}" class="text-white mx-2">Products</a> |
            <a href="{{ route('contact') }}" class="text-white mx-2">Contact</a>
        </p>
    </div>
</footer>

<style>
    .bg-pink { background-color: #500c27 !important; }
    footer a:hover { text-decoration: underline; }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
