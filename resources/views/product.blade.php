@extends('layouts.layout')

@section('body-class', 'product-page')
@section('content')
    <style>
        body.product-page {
            background: linear-gradient(135deg, #ffe6f0 0%, #ffeee9 100%);
        }

        .product-container {
            background-color: #f4a4be;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }


        .product-image {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }


        .review-box {
            background-color: #d81d5e;
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }
    </style>

    <div class="container mt-4 product-container">
        ...
    </div>
@endsection
