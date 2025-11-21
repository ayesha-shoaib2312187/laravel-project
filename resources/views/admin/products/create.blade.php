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
        padding: 40px;
        max-width: 800px;
        margin: 0 auto;
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

    .btn-back {
        background-color: #6c757d;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-back:hover {
        background-color: #5a6268;
        color: #fff;
    }

    .form-label {
        color: #650b38;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #950f52;
        box-shadow: 0 0 0 0.2rem rgba(149, 15, 82, 0.25);
        outline: none;
    }

    .btn-submit {
        background-color: #950f52;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #7a0c42;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(149, 15, 82, 0.3);
    }

    .btn-cancel {
        background-color: #6c757d;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px 30px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background-color: #5a6268;
        color: #fff;
    }

    .text-danger {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
    }

    .form-text {
        color: #6c757d;
        font-size: 0.875rem;
        margin-top: 5px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 30px;
    }
</style>

<div class="admin-container">
    <div class="container">
        <div class="admin-card">
            <div class="admin-header">
                <h1 class="admin-title">Create New Product</h1>
                <a href="{{ route('products.index') }}" class="btn btn-back">
                    ← Back to Products
                </a>
            </div>

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="category" class="form-label">Category *</label>
                    <select name="category" id="category" class="form-select" required>
                        <option value="">Select a category</option>
                        <option value="Flowers" {{ old('category') == 'Flowers' ? 'selected' : '' }}>Flowers</option>
                        <option value="toys" {{ old('category') == 'toys' ? 'selected' : '' }}>Toys</option>
                        <option value="bags" {{ old('category') == 'bags' ? 'selected' : '' }}>Bags</option>
                        <option value="blankets" {{ old('category') == 'blankets' ? 'selected' : '' }}>Blankets</option>
                        <option value="cardigan" {{ old('category') == 'cardigan' ? 'selected' : '' }}>Cardigan</option>
                        <option value="beanies" {{ old('category') == 'beanies' ? 'selected' : '' }}>Beanies</option>
                        <option value="keychains" {{ old('category') == 'keychains' ? 'selected' : '' }}>Keychains</option>
                    </select>
                    @error('category')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Title *</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="short" class="form-label">Short Description *</label>
                    <input type="text" name="short" id="short" class="form-control" value="{{ old('short') }}" required placeholder="Brief description for product cards">
                    @error('short')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="desc" class="form-label">Full Description *</label>
                    <textarea name="desc" id="desc" class="form-control" rows="4" required>{{ old('desc') }}</textarea>
                    @error('desc')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (Rs) *</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" step="0.01" min="0" required>
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image Filename</label>
                    <input type="text" name="image" id="image" class="form-control" value="{{ old('image') }}" placeholder="e.g., product.jpg">
                    <div class="form-text">Enter the filename of the image (should be in public/images folder)</div>
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('products.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn btn-submit">Create Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
