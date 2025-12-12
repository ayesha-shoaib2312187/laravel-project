@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold" style="color: #950f52;">Contact Messages</h2>
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
                                <th class="ps-4 py-3 text-secondary">ID</th>
                                <th class="py-3 text-secondary">Name</th>
                                <th class="py-3 text-secondary">Email</th>
                                <th class="py-3 text-secondary">Subject</th>
                                <th class="py-3 text-secondary">Received</th>
                                <th class="pe-4 py-3 text-end text-secondary">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $message)
                                <tr>
                                    <td class="ps-4 fw-semibold">#{{ $message->id }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td><a href="mailto:{{ $message->email }}"
                                            class="text-decoration-none text-dark">{{ $message->email }}</a></td>
                                    <td>{{ Str::limit($message->subject ?? 'No Subject', 30) }}</td>
                                    <td>{{ $message->created_at->format('M d, Y h:i A') }}</td>
                                    <td class="pe-4 text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.contact-messages.show', $message->id) }}"
                                                class="btn btn-sm btn-outline-primary" title="View">
                                                View
                                            </a>
                                            <form action="{{ route('admin.contact-messages.destroy', $message->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this message?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <h5 class="fw-normal">No messages found</h5>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($messages->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $messages->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
