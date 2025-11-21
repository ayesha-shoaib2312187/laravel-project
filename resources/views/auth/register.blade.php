@extends('layouts.layout')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #ffe6f0 0%, #ffeee9 100%) !important;
        min-height: 100vh;
    }

    .register-container {
        max-width: 450px;
        margin: 60px auto;
    }

    .register-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 40px;
    }

    .register-title {
        color: #950f52;
        font-weight: 600;
        margin-bottom: 30px;
        text-align: center;
    }

    .form-label {
        color: #650b38;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #950f52;
        box-shadow: 0 0 0 0.2rem rgba(149, 15, 82, 0.25);
    }

    .btn-register {
        background-color: #950f52;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px 30px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-register:hover {
        background-color: #7a0c42;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(149, 15, 82, 0.3);
    }

    .login-link {
        text-align: center;
        margin-top: 20px;
        color: #650b38;
    }

    .login-link a {
        color: #950f52;
        text-decoration: none;
        font-weight: 500;
    }

    .login-link a:hover {
        color: #7a0c42;
        text-decoration: underline;
    }

    .text-danger {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
    }
</style>

<div class="register-container">
    <div class="register-card">
        <h2 class="register-title">Create Account</h2>
        <p class="text-center text-muted mb-4">Join Frolic Stitch today</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       autofocus 
                       autocomplete="name"
                       placeholder="Enter your name">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autocomplete="username"
                       placeholder="Enter your email">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" 
                       class="form-control @error('password') is-invalid @enderror"
                       type="password"
                       name="password" 
                       required 
                       autocomplete="new-password"
                       placeholder="Create a password">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" 
                       class="form-control"
                       type="password"
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password"
                       placeholder="Confirm your password">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-register">
                Register
            </button>
        </form>

        <!-- Login Link -->
        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Login here</a>
        </div>
    </div>
</div>
@endsection
