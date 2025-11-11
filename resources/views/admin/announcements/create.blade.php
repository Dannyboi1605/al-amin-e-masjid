@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Cipta Pengumuman Baru</h1>
    
    <div class="card shadow-sm">
        <div class="card-body">
            
            <form method="POST" action="{{ route('admin.announcements.store') }}">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Pengumuman</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Isi Kandungan</label>
                    <textarea name="content" id="content" rows="10" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Cipta Pengumuman</button>
                <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">Batal</a>
            </form>
            
        </div>
    </div>
</div>
@endsection