@extends('layouts.layout')

@section('content')
    <style>
        /* Contact form container styling */
        .contact-form {
            max-width: 700px;
            margin: 80px auto;
            /* center form with spacing from top */
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        /* Primary button styling */
        .btn-pink {
            background-color: #950f52;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            transition: background-color 0.3s ease;
        }

        /* Hover effect for button */
        .btn-pink:hover {
            background-color: #af2267;
        }
    </style>

    <div class="container contact-form">
        <!-- Form heading -->
        <h2 class="text-center text-primary fw-bold mb-4">Contact Us 💌</h2>
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Your Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Your Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Subject</label>
                <input type="text" name="subject" class="form-control" placeholder="Enter subject">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Message</label>
                <textarea name="message" class="form-control" rows="4" placeholder="Write your message..."
                    required></textarea>
            </div>

            <button type="submit" class="btn btn-pink w-100">Send Message</button>
        </form>
    </div>
@endsection