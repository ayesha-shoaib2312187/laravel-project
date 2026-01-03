@extends('layouts.layout')

@section('content')
    <style>
        .contact-container {
            max-width: 1000px;
            margin: 60px auto;
        }

        /* Info Card Styling */
        .info-card {
            background-color: #950f52;
            color: #fff;
            border-radius: 15px;
            padding: 40px;
            height: 100%;
            box-shadow: 0 6px 20px rgba(149, 15, 82, 0.2);
        }

        .info-item {
            margin-bottom: 30px;
        }

        .info-icon {
            font-size: 1.5rem;
            margin-bottom: 10px;
            display: block;
        }

        .info-label {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 5px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.9;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 300;
            opacity: 0.9;
            line-height: 1.6;
            white-space: pre-line;
            /* Respect newlines in address/hours */
        }

        /* Form Card Styling from previous design, tweaked */
        .contact-form-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .btn-pink {
            background-color: #950f52;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-pink:hover {
            background-color: #7a0c42;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(149, 15, 82, 0.3);
        }
    </style>

    <div class="container contact-container">
        <div class="row g-0">
            <!-- Left Column: Contact Info -->
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="info-card">
                    <h2 class="fw-bold mb-5">Get in Touch</h2>

                    <div class="info-item">
                        <span class="info-icon">📍</span>
                        <span class="info-label">Address</span>
                        <div class="info-value">
                            {{ $contactInfo->address ?? 'Address not set' }}
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-icon">📞</span>
                        <span class="info-label">Phone</span>
                        <div class="info-value">
                            {{ $contactInfo->phone ?? 'Phone not set' }}
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-icon">✉️</span>
                        <span class="info-label">Email</span>
                        <div class="info-value">
                            {{ $contactInfo->email ?? 'Email not set' }}
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-icon">⏰</span>
                        <span class="info-label">Opening Hours</span>
                        <div class="info-value">
                            {{ $contactInfo->opening_hours ?? 'Hours not set' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Contact Form -->
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <h3 class="text-primary fw-bold mb-2">Send us a Message 💌</h3>
                    <p class="text-muted mb-4">We'd love to hear from you. Fill out the form below.</p>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Your Name</label>
                                <input type="text" name="name" class="form-control bg-light border-0" placeholder="John Doe"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Your Email</label>
                                <input type="email" name="email" class="form-control bg-light border-0"
                                    placeholder="john@example.com" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Subject</label>
                            <input type="text" name="subject" class="form-control bg-light border-0"
                                placeholder="How can we help?">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Message</label>
                            <textarea name="message" class="form-control bg-light border-0" rows="5"
                                placeholder="Write your message here..." required></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-pink">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection