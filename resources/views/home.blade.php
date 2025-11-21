@extends('layouts.layout')

@section('content')
    <section class="position-relative text-center text-white">
        <div class="banner-container position-relative">
            <img src="{{ asset('images/banner2.png') }}" class="img-fluid w-100 banner-img" alt="Frolic Stitch Banner">

            <div class="banner-overlay d-flex flex-column align-items-center justify-content-center">
                <h2 class="lead mb-4 text-shadow">Handmade crochet creations made with love.</h2>
                <div>
                    <a class="btn btn-pink rounded-pill me-2" href="{{ route('products') }}">Shop</a>
                    <a class="btn btn-outline-light rounded-pill" href="{{ route('contact') }}">Contact Us</a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .banner-container {
            width: 100%;
            height: 90vh;
            position: relative;
            overflow: hidden;
        }

        .banner-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .banner-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            text-align: center;
        }

        .text-shadow {
            text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.6);
            font-size: 1.5rem;
            max-width: 600px;
        }

        .btn-pink {
            background-color: #fffdfe;
            color: #650b38;
            border: none;
            padding: 12px 28px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-pink:hover {
            color: #100209;
        }

        body {
            background: linear-gradient(135deg, #ffe6f0 0%, #ffeee9 100%);
            min-height: 100vh;
        }

        .card {
            border-radius: 15px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            background-color: #fff;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        h2.text-primary {
            color: #950f52 !important;
        }
    </style>

    <section class="container py-5 text-center">
        <h2 class="fw-semibold mb-3 text-primary">About Frolic Stitch</h2>
        <p class="lead text-muted mb-4 px-3">
            At <strong>Frolic Stitch</strong>, we craft soulful crochet pieces that bring warmth, charm, and a touch of artistry to every home — turning threads into memories.
        </p>
    </section>

    <section class="container py-5">
        <h2 class="fw-semibold mb-4 text-center text-primary">Featured Creations</h2>
        <div class="row">
            @php
                $sample = [
                    ['id'=>1,'title'=>'Crochet Flower Bouquet','short'=>'A colorful handmade bouquet','price'=>2500,'image'=>'bouquet.png'],
                    ['id'=>2,'title'=>'Amigurumi Bunny','short'=>'Cute crochet doll for kids','price'=>1200,'image'=>'Amigurumi Bunny.webp'],
                    ['id'=>3,'title'=>'Boho Tote Bag','short'=>'Eco-friendly tote','price'=>2200,'image'=>'Boho bag.webp'],
                ];
            @endphp

            @foreach($sample as $product)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <img src="{{ asset('images/' . $product['image']) }}" class="card-img-top" alt="{{ $product['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark">{{ $product['title'] }}</h5>
                            <p class="text-muted small">{{ $product['short'] }}</p>
                            <p class="fw-semibold mb-2">Rs {{ $product['price'] }}</p>
                            <a href="{{ route('product.show', $product['id']) }}" class="btn btn-pink">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
