@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold" style="color: #950f52;">Orders</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 text-secondary">Order #</th>
                                <th class="py-3 text-secondary">Customer</th>
                                <th class="py-3 text-secondary">Total</th>
                                <th class="py-3 text-secondary">Status</th>
                                <th class="py-3 text-secondary">Date</th>
                                <th class="pe-4 py-3 text-end text-secondary">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td class="ps-4 fw-semibold text-primary">{{ $order->order_number }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $order->customer_name }}</div>
                                        <div class="small text-muted">{{ $order->email }}</div>
                                    </td>
                                    <td class="fw-bold">${{ number_format($order->total, 2) }}</td>
                                    <td>
                                        @if($order->status === 'Completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($order->status === 'Pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->date->format('M d, Y') }}<br><small
                                            class="text-muted">{{ $order->date->format('h:i A') }}</small></td>
                                    <td class="pe-4 text-end">
                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                            class="btn btn-sm btn-outline-primary" title="View Details">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <h5 class="fw-normal">No orders found</h5>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($orders->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection