@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold" style="color: #950f52;">Profile</h2>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
                </div>

                <!-- Update Profile Information -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h4 class="fw-bold" style="color: #333;">Profile Information</h4>
                        <p class="text-muted small">Update your account's profile information and email address.</p>
                    </div>
                    <div class="card-body p-4">
                        @if (session('status') === 'profile-updated')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Profile updated successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                    <div class="mt-2">
                                        <p class="text-muted small">
                                            Your email address is unverified.
                                            <button form="send-verification" class="btn btn-link p-0 text-decoration-none"
                                                style="font-size: inherit;">Click here to re-send the verification
                                                email.</button>
                                        </p>
                                        @if (session('status') === 'verification-link-sent')
                                            <p class="text-success small fw-bold">
                                                A new verification link has been sent to your email address.
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn text-white fw-bold py-2"
                                    style="background-color: #950f52;">Save</button>
                            </div>
                        </form>
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>
                    </div>
                </div>

                <!-- Update Password -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h4 class="fw-bold" style="color: #333;">Update Password</h4>
                        <p class="text-muted small">Ensure your account is using a long, random password to stay secure.</p>
                    </div>
                    <div class="card-body p-4">
                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Password updated successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="current_password" class="form-label fw-semibold">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password"
                                    autocomplete="current-password">
                                @error('current_password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">New Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    autocomplete="new-password">
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" autocomplete="new-password">
                                @error('password_confirmation')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn text-white fw-bold py-2"
                                    style="background-color: #950f52;">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="card shadow-sm border-0 border-danger">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h4 class="fw-bold text-danger">Delete Account</h4>
                        <p class="text-muted small">Once your account is deleted, all of its resources and data will be
                            permanently deleted.</p>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-grid">
                            <button type="button" class="btn btn-danger fw-bold py-2" data-bs-toggle="modal"
                                data-bs-target="#deleteAccountModal">
                                Delete Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
                @csrf
                @method('delete')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="deleteAccountModalLabel">Are you sure you want to delete your
                        account?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Please
                        enter your password to confirm you would like to permanently delete your account.
                    </p>
                    <div class="mb-3">
                        <label for="password_delete" class="form-label visually-hidden">Password</label>
                        <input type="password" class="form-control" id="password_delete" name="password"
                            placeholder="Password" required>
                        @error('password', 'userDeletion')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </div>
            </form>
        </div>
    </div>

    @error('password', 'userDeletion')
        <script>
            // Re-open modal if there are errors in the userDeletion bag
            document.addEventListener('DOMContentLoaded', function () {
                var myModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
                myModal.show();
            });
        </script>
    @enderror

@endsection