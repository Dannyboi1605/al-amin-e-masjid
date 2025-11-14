@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Cipta Forum Baru</h1>
    
    <div class="card shadow-sm">
        <div class="card-body">
            
            <form method="POST" action="{{ route('admin.forums.store') }}">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Tajuk Forum</label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        class="form-control @error('title') is-invalid @enderror" 
                        value="{{ old('title') }}" 
                        required
                        placeholder="Masukkan tajuk yang menarik..."
                    >
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Slug akan dijana secara automatik dari tajuk</small>
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Kandungan Forum</label>
                    <textarea 
                        name="content" 
                        id="content" 
                        rows="12" 
                        class="form-control @error('content') is-invalid @enderror" 
                        required
                        placeholder="Tulis kandungan forum di sini..."
                    >{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Cipta Forum
                    </button>
                    <a href="{{ route('admin.forums.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection
