@extends('layouts.app')

@section('content')
<!-- ===========================
     ANNOUNCEMENT DETAIL PAGE
     Single announcement view
=========================== -->

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1><i class="fas fa-newspaper me-2"></i>{{ $announcement->title }}</h1>
                <p class="mb-0">
                    <i class="far fa-calendar-alt me-2"></i>
                    {{ $announcement->created_at->format('d M Y, h:i A') }}
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Section -->
<div class="content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <!-- Announcement Content Card -->
                <div class="modern-card">
                    <div class="card-body">
                        
                        <!-- Announcement Icon -->
                        <div class="icon-circle mb-4">
                            <i class="fas fa-bullhorn"></i>
                        </div>

                        <!-- Full Content -->
                        <div class="announcement-content" style="font-size: 1.1rem; line-height: 1.9; color: #333;">
                            {!! nl2br(e($announcement->content)) !!}
                        </div>

                        <!-- Divider -->
                        <hr class="my-4" style="border-top: 2px solid #e9ecef;">

                        <!-- Meta Information -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="text-muted">
                                <i class="fas fa-user me-2"></i>
                                <small>Diterbitkan oleh Pengurusan Masjid</small>
                            </div>
                            <div class="text-muted">
                                <i class="far fa-clock me-2"></i>
                                <small>{{ $announcement->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('announcements.index.public') }}" class="btn btn-modern-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Senarai Pengumuman
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection