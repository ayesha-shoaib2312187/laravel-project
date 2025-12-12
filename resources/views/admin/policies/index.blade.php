@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold" style="color: #950f52;">Policies</h2>
            <div class="d-flex text-end">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary me-2">Dashboard</a>
                <a href="{{ route('admin.policies.create') }}" class="btn text-white fw-bold"
                    style="background-color: #950f52;">+ New Policy</a>
            </div>
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
                                <th class="ps-4 py-3 text-secondary">Title</th>
                                <th class="py-3 text-secondary">Type</th>
                                <th class="py-3 text-secondary">Last Updated</th>
                                <th class="pe-4 py-3 text-end text-secondary">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($policies as $policy)
                                <tr>
                                    <td class="ps-4 fw-bold">{{ $policy->title }}</td>
                                    <td><span class="badge bg-secondary">{{ $policy->type }}</span></td>
                                    <td>{{ $policy->updated_date->format('M d, Y') }}</td>
                                    <td class="pe-4 text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.policies.edit', $policy->id) }}"
                                                class="btn btn-sm btn-outline-primary" title="Edit">
                                                ✏️
                                            </a>
                                            <form action="{{ route('admin.policies.destroy', $policy->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this policy?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <h5 class="fw-normal">No policies found</h5>
                                        <p class="small">Click "New Policy" to add one.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($policies->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $policies->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection