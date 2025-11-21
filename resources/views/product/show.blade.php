@extends('layouts.layout')

@section('content')
    <div class="container py-5 text-center">
        <img src="{{ asset('images/' . $product['image']) }}"
             class="img-fluid rounded mb-4 shadow-sm"
             alt="{{ $product['title'] }}"
             style="max-width: 400px;">

        <h1 class="fw-bold text-primary mb-3">{{ $product['title'] }}</h1>
        <p class="lead text-muted">{{ $product['description'] }}</p>
        <p class="fw-semibold mt-3">Price: Rs {{ $product['price'] }}</p>

        <a href="{{ route('products') }}" class="btn btn-pink mt-4">← Back to Products</a>
    </div>
@endsection
