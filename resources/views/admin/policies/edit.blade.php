@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="fw-bold" style="color: #950f52;">Edit Policy</h3>
                            <a href="{{ route('admin.policies.index') }}"
                                class="btn btn-outline-secondary btn-sm">Cancel</a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.policies.update', $policy->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label fw-semibold">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title', $policy->title) }}" required>
                                @error('title')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label fw-semibold">Type</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="Page" {{ old('type', $policy->type) == 'Page' ? 'selected' : '' }}>Page
                                    </option>
                                    <option value="Info" {{ old('type', $policy->type) == 'Info' ? 'selected' : '' }}>Info
                                    </option>
                                    <option value="Legal" {{ old('type', $policy->type) == 'Legal' ? 'selected' : '' }}>Legal
                                    </option>
                                </select>
                                @error('type')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="content" class="form-label fw-semibold">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="10"
                                    required>{{ old('content', $policy->content) }}</textarea>
                                @error('content')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn text-white fw-bold py-2"
                                    style="background-color: #950f52;">
                                    Update Policy
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
