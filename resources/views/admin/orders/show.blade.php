@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <a href="{{ route('admin.orders.index') }}"
                            class="text-decoration-none small text-muted mb-2 d-block">&larr; Back to Orders</a>
                        <h2 class="fw-bold" style="color: #950f52;">Order #{{ $order->order_number }}</h2>
                    </div>
                    <div>
                        <span
                            class="badge {{ $order->status === 'Completed' ? 'bg-success' : ($order->status === 'Pending' ? 'bg-warning text-dark' : 'bg-danger') }} fs-6 px-3 py-2">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-white border-bottom py-3">
                                <h5 class="fw-bold mb-0">Order Summary</h5>
                            </div>
                            <div class="card-body p-4">
                                <!-- Since we don't have items in the database yet, we show a placeholder or just the total -->
                                <div class="alert alert-info">
                                    <small>Note: Individual order items are not currently stored in the database.</small>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-3">
                                    <h5 class="fw-bold text-muted">Total Amount</h5>
                                    <h3 class="fw-bold" style="color: #950f52;">${{ number_format($order->total, 2) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-white border-bottom py-3">
                                <h5 class="fw-bold mb-0">Customer Details</h5>
                            </div>
                            <div class="card-body p-4">
                                <h6 class="fw-bold text-muted text-uppercase small">Customer Name</h6>
                                <p class="fs-5 mb-3">{{ $order->customer_name }}</p>

                                <h6 class="fw-bold text-muted text-uppercase small">Email Address</h6>
                                <p class="mb-3"><a href="mailto:{{ $order->email }}"
                                        class="text-decoration-none text-dark">{{ $order->email }}</a></p>

                                <h6 class="fw-bold text-muted text-uppercase small">Order Date</h6>
                                <p class="mb-0">{{ $order->date->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 bg-light">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-3">Update Status</h5>
                                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="status" class="form-label visually-hidden">Status</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="Completed" {{ $order->status === 'Completed' ? 'selected' : '' }}>
                                                Completed</option>
                                            <option value="Cancelled" {{ $order->status === 'Cancelled' ? 'selected' : '' }}>
                                                Cancelled</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-dark w-100 fw-bold">Update Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection