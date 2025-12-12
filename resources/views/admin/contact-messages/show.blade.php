@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="mb-4">
                    <a href="{{ route('admin.contact-messages.index') }}" class="text-decoration-none"
                        style="color: #950f52;">
                        &larr; Back to Messages
                    </a>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="text-muted mb-1">Subject</h5>
                                <h3 class="fw-bold mb-0" style="color: #333;">{{ $message->subject ?? 'No Subject' }}</h3>
                            </div>
                            <span class="badge rounded-pill bg-light text-dark border p-2">
                                {{ $message->created_at->format('M d, Y h:i A') }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <h6 class="fw-bold text-uppercase text-muted small">From</h6>
                                <p class="mb-0 fs-5">{{ $message->name }}</p>
                                <a href="mailto:{{ $message->email }}" class="text-decoration-none"
                                    style="color: #950f52;">{{ $message->email }}</a>
                                @if($message->phone)
                                    <p class="mb-0 mt-1"><small class="text-muted">Phone:</small> {{ $message->phone }}</p>
                                @endif
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="message-content">
                            <h6 class="fw-bold text-uppercase text-muted small mb-3">Message</h6>
                            <div class="p-3 bg-light rounded-3" style="min-height: 200px;">
                                {!! nl2br(e($message->message)) !!}
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="reply-section">
                            @if($message->reply)
                                <h6 class="fw-bold text-uppercase text-muted small mb-3">Previous Reply</h6>
                                <div class="p-3 bg-light rounded-3 border-start border-4 border-success mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <small class="text-muted">Replied on
                                            {{ $message->replied_at ? $message->replied_at->format('M d, Y h:i A') : 'N/A' }}</small>
                                        <span class="badge bg-success">Sent</span>
                                    </div>
                                    {!! nl2br(e($message->reply)) !!}
                                </div>
                            @else
                                <h6 class="fw-bold text-uppercase text-muted small mb-3">Reply to Message</h6>
                                <form action="{{ route('admin.contact-messages.reply', $message->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <textarea name="reply" class="form-control" rows="5"
                                            placeholder="Type your reply here..." required></textarea>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn text-white" style="background-color: #950f52;">
                                            Send Reply
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                            <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this message?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger text-white">
                                    Delete Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection