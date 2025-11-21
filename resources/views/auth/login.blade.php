@extends('layouts.layout')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #ffe6f0 0%, #ffeee9 100%) !important;
        min-height: 100vh;
    }

    .login-container {
        max-width: 450px;
        margin: 60px auto;
    }

    .login-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 40px;
    }

    .login-title {
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

    .btn-login {
        background-color: #950f52;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px 30px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        background-color: #7a0c42;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(149, 15, 82, 0.3);
    }

    .btn-link-forgot {
        color: #950f52;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .btn-link-forgot:hover {
        color: #7a0c42;
        text-decoration: underline;
    }

    .register-link {
        text-align: center;
        margin-top: 20px;
        color: #650b38;
    }

    .register-link a {
        color: #950f52;
        text-decoration: none;
        font-weight: 500;
    }

    .register-link a:hover {
        color: #7a0c42;
        text-decoration: underline;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 20px;
    }

    .text-danger {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
    }

    .form-check-input:checked {
        background-color: #950f52;
        border-color: #950f52;
    }

    .form-check-label {
        color: #650b38;
        font-size: 0.9rem;
    }
</style>

<div class="login-container">
    <div class="login-card">
        <h2 class="login-title">Welcome Back</h2>
        <p class="text-center text-muted mb-4">Login to your Frolic Stitch account</p>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
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
                       autocomplete="current-password"
                       placeholder="Enter your password">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-3 form-check">
                <input id="remember_me" 
                       type="checkbox" 
                       class="form-check-input" 
                       name="remember">
                <label class="form-check-label" for="remember_me">
                    Remember me
                </label>
            </div>

            <!-- Forgot Password Link -->
            <div class="mb-4 text-end">
                @if (Route::has('password.request'))
                    <a class="btn-link-forgot" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-login">
                Log in
            </button>
        </form>

        <!-- Register Link -->
        <div class="register-link">
            Don't have an account? <a href="{{ route('register') }}">Register here</a>
        </div>
    </div>
</div>
@endsection
