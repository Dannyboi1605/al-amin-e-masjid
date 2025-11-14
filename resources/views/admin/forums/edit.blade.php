@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Edit Forum</h1>
    
    <div class="card shadow-sm">
        <div class="card-body">
            
            <form method="POST" action="{{ route('admin.forums.update', $forum->slug) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Tajuk Forum</label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        class="form-control @error('title') is-invalid @enderror" 
                        value="{{ old('title', $forum->title) }}" 
                        required
                    >
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Slug semasa: <strong>{{ $forum->slug }}</strong></small>
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Kandungan Forum</label>
                    <textarea 
                        name="content" 
                        id="content" 
                        rows="12" 
                        class="form-control @error('content') is-invalid @enderror" 
                        required
                    >{{ old('content', $forum->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Dicipta oleh: <strong>{{ $forum->author->name }}</strong> pada {{ $forum->created_at->format('d M Y, h:i A') }}
                    </small>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-2"></i>Kemaskini Forum
                    </button>
                    <a href="{{ route('admin.forums.index') }}" class="btn btn-secondary">Batal</a>
                    <a href="{{ route('forums.show', $forum->slug) }}" class="btn btn-info" target="_blank">
                        <i class="fas fa-eye me-2"></i>Lihat Forum
                    </a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection
