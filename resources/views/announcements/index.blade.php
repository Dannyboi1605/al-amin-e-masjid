@extends('layouts.app') 

@section('content')
<!-- ===========================
     ANNOUNCEMENTS INDEX PAGE
     Modern grid layout with cards
=========================== -->

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-bullhorn me-2"></i>Pengumuman Terkini</h1>
        <p class="mb-0">Berita dan maklumat penting dari pengurusan masjid</p>
    </div>
</div>

<!-- Main Content Section -->
<div class="content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                {{-- Loop through announcements --}}
                @foreach($announcements as $announcement)
                <div class="modern-card">
                    <div class="card-body">
                        
                        <!-- Announcement Icon -->
                        <div class="icon-circle">
                            <i class="fas fa-newspaper"></i>
                        </div>

                        <!-- Announcement Title -->
                        <h2 class="fw-bold text-dark mb-2">{{ $announcement->title }}</h2>
                        
                        <!-- Meta Information -->
                        <p class="text-muted small mb-3">
                            <i class="far fa-calendar-alt me-1"></i> 
                            Diterbitkan: {{ $announcement->created_at->format('d M Y, h:i A') }}
                        </p>

                        <!-- Announcement Preview -->
                        <p class="card-text mb-3" style="line-height: 1.8;">
                            {{ Str::limit($announcement->content, 200, '...') }}
                        </p>

                        {{-- Link to Detail Page --}}
                        <a href="{{ route('announcements.show.public', $announcement->id) }}" 
                           class="btn btn-modern-primary">
                            Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
                @endforeach
                
                {{-- Empty State --}}
                @if($announcements->isEmpty())
                    <div class="modern-alert alert-info text-center">
                        <div class="icon-circle mx-auto mb-3">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h4>Tiada Pengumuman</h4>
                        <p class="mb-0">Tiada pengumuman aktif buat masa ini. Sila semak kembali tidak lama lagi.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection