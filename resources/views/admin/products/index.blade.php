@extends('layouts.layout')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #ffe6f0 0%, #ffeee9 100%) !important;
        min-height: 100vh;
    }

    .admin-container {
        padding: 40px 0;
    }

    .admin-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 20px;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .admin-title {
        color: #950f52;
        font-weight: 600;
        margin: 0;
    }

    .btn-add {
        background-color: #950f52;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-add:hover {
        background-color: #7a0c42;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(149, 15, 82, 0.3);
        color: #fff;
    }

    .table {
        width: 100%;
        margin-bottom: 0;
    }

    .table thead {
        background-color: #faf6f8;
    }

    .table thead th {
        color: #950f52;
        font-weight: 600;
        border-bottom: 2px solid #950f52;
        padding: 15px;
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
    }

    .table tbody tr:hover {
        background-color: #faf6f8;
    }

    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #f0f0f0;
    }

    .btn-edit {
        color: #950f52;
        text-decoration: none;
        font-weight: 500;
        margin-right: 15px;
        transition: color 0.3s ease;
    }

    .btn-edit:hover {
        color: #7a0c42;
        text-decoration: underline;
    }

    .btn-delete {
        color: #dc3545;
        background: none;
        border: none;
        font-weight: 500;
        padding: 0;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .btn-delete:hover {
        color: #c82333;
        text-decoration: underline;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state p {
        color: #650b38;
        font-size: 1.1rem;
        margin-bottom: 20px;
    }

    .btn-create-first {
        background-color: #950f52;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px 30px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-create-first:hover {
        background-color: #7a0c42;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(149, 15, 82, 0.3);
        color: #fff;
    }
</style>

<div class="admin-container">
    <div class="container">
        <div class="admin-card">
            <div class="admin-header">
                <h1 class="admin-title">Product Management</h1>
                <a href="{{ route('products.create') }}" class="btn btn-add">
                    ➕ Add New Product
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if($products->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Short Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->title }}" class="product-image">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    <td><strong>{{ $product->title }}</strong></td>
                                    <td>{{ $product->category }}</td>
                                    <td><strong>Rs {{ number_format($product->price, 2) }}</strong></td>
                                    <td>{{ Str::limit($product->short, 50) }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn-edit">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <p>No products found.</p>
                    <a href="{{ route('products.create') }}" class="btn-create-first">
                        Create Your First Product
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
