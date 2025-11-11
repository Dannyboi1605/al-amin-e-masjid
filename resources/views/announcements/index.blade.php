@extends('layouts.app') 

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-primary text-center">Pengumuman Terkini</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            @foreach($announcements as $announcement)
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">
                    
                    <h2 class="card-title fw-bold text-dark mb-1">{{ $announcement->title }}</h2>
                    
                    <p class="text-muted small mb-3">
                        <i class="far fa-calendar-alt me-1"></i> Diterbitkan: {{ $announcement->created_at->format('d M Y, h:i A') }}
                    </p>

                    <p class="card-text">{{ Str::limit($announcement->content, 150, '...') }}</p>

                    {{-- Link ke Detail Page --}}
                    <a href="{{ route('announcements.show.public', $announcement->id) }}" class="btn btn-sm btn-outline-primary mt-2">
                        Baca Lanjut <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
            
            @if($announcements->isEmpty())
                <div class="alert alert-info text-center" role="alert">
                    Tiada pengumuman aktif buat masa ini.
                </div>
            @endif

        </div>
    </div>
</div>
@endsection