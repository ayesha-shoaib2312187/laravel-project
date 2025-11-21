@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">{{ $slug }}</h1>

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 text-center">
                        <img src="{{ asset('images/' . $product['image']) }}" class="card-img-top" alt="{{ $product['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['title'] }}</h5>
                            <p class="text-muted">{{ $product['desc'] }}</p>
                            <p class="fw-semibold">Rs {{ $product['price'] }}</p>
                            <a href="#" class="btn btn-purple">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
