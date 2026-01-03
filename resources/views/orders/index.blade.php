@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-pink">My Orders</h1>

        @if($orders->isEmpty())
            <div class="alert alert-info">You have no past orders.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-pink text-white">
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>Rs {{ number_format($order->total, 2) }}</td>
                                <td>
                                    <span class="badge {{ $order->status == 'Completed' ? 'bg-success' : 'bg-warning' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-sm btn-outline-pink">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <style>
        .text-pink {
            color: #950f52 !important;
        }

        .bg-pink {
            background-color: #950f52 !important;
        }

        .btn-outline-pink {
            color: #950f52;
            border-color: #950f52;
        }

        .btn-outline-pink:hover {
            background-color: #950f52;
            color: #fff;
        }
    </style>
@endsection