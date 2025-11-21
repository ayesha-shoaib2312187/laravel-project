@extends('layouts.layout')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #ffe6f0 0%, #ffeee9 100%) !important;
        min-height: 100vh;
    }

    .dashboard-container {
        padding: 40px 0;
    }

    .dashboard-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 40px;
        margin-bottom: 30px;
    }

    .dashboard-title {
        color: #950f52;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .welcome-text {
        color: #650b38;
        font-size: 1.1rem;
        margin-bottom: 30px;
    }

    .admin-section {
        background: #faf6f8;
        border-radius: 12px;
        padding: 30px;
        margin-top: 20px;
    }

    .admin-section h3 {
        color: #950f52;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .btn-admin {
        background-color: #950f52;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-admin:hover {
        background-color: #7a0c42;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(149, 15, 82, 0.3);
        color: #fff;
    }

    .admin-description {
        color: #650b38;
        font-size: 0.95rem;
        margin-top: 15px;
    }

    .quick-links {
        margin-top: 30px;
    }

    .quick-links h4 {
        color: #950f52;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .quick-link-item {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .quick-link-item:hover {
        border-color: #950f52;
        box-shadow: 0 2px 8px rgba(149, 15, 82, 0.1);
    }

    .quick-link-item a {
        color: #950f52;
        text-decoration: none;
        font-weight: 500;
    }

    .quick-link-item a:hover {
        color: #7a0c42;
    }
</style>

<div class="dashboard-container">
    <div class="container">
        <div class="dashboard-card">
            <h1 class="dashboard-title">Dashboard</h1>
            <p class="welcome-text">Welcome back! You're logged in to Frolic Stitch.</p>

            <div class="admin-section">
                <h3>Admin Panel</h3>
                <a href="{{ route('products.index') }}" class="btn btn-admin">
                    Manage Products (CRUD)
                </a>
                <p class="admin-description">
                    Create, view, edit, and delete products from the database. All changes will be reflected immediately on the website.
                </p>
            </div>

            <div class="quick-links">
                <h4>Quick Links</h4>
                <div class="quick-link-item">
                    <a href="{{ route('home') }}">
                        🏠 Homepage
                    </a>
                </div>
                <div class="quick-link-item">
                    <a href="{{ route('products') }}">
                        🛍️ View Products
                    </a>
                </div>
                <div class="quick-link-item">
                    <a href="{{ route('profile.edit') }}">
                        👤 Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
