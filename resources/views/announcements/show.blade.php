@extends('layouts.app')

@section('content')
<div class="container my-5">
    
    <a href="{{ route('announcements.index.public') }}" class="btn btn-secondary btn-sm mb-3">
        ← Kembali ke Senarai Pengumuman
    </a>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            
            <h1 class="card-title fw-bold text-dark mb-1">{{ $announcement->title }}</h1>
            <p class="text-muted small mb-4">
                <i class="far fa-calendar-alt me-1"></i> Diterbitkan: {{ $announcement->created_at->format('d M Y, h:i A') }}
            </p>
            
            <hr>

            <div class="mb-4" style="line-height: 1.8;">
                <p class="card-text">{{ $announcement->content }}</p>
            </div>
            
        </div>
    </div>
</div>
@endsection