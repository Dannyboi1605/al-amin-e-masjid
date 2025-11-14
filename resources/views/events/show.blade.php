@extends('layouts.app')

@section('content')
<!-- ===========================
     EVENT DETAIL PAGE
     Single event view
=========================== -->

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1><i class="fas fa-calendar-check me-2"></i>{{ $event->title }}</h1>
                <p class="mb-0">
                    <i class="fas fa-calendar-day me-2"></i>{{ $event->date->format('d M Y') }}
                    <span class="mx-2">•</span>
                    <i class="far fa-clock me-2"></i>{{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}
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
                
                <!-- Event Details Card -->
                <div class="modern-card">
                    <div class="card-body">
                        
                        <!-- Event Icon -->
                        <div class="icon-circle mb-4">
                            <i class="fas fa-calendar-alt"></i>
                        </div>

                        <!-- Event Meta Information -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon-circle" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="ms-3">
                                        <small class="text-muted d-block">Lokasi</small>
                                        <strong>{{ $event->location }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon-circle" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                        <i class="far fa-clock"></i>
                                    </div>
                                    <div class="ms-3">
                                        <small class="text-muted d-block">Masa</small>
                                        <strong>{{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <hr class="my-4" style="border-top: 2px solid #e9ecef;">

                        <!-- Event Description -->
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-info-circle me-2"></i>Keterangan Acara
                        </h5>
                        <div class="event-description" style="font-size: 1.1rem; line-height: 1.9; color: #333;">
                            {!! nl2br(e($event->description)) !!}
                        </div>

                        <!-- Volunteer Section -->
                        @auth
                            @if($event->allow_volunteers)
                                <div class="mt-4 p-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px; color: white;">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <div class="mb-3 mb-md-0">
                                            <h5 class="mb-2 fw-bold">
                                                <i class="fas fa-hands-helping me-2"></i>Jadi Sukarelawan
                                            </h5>
                                            <p class="mb-0 opacity-90">Sertai kami sebagai sukarelawan untuk acara ini!</p>
                                        </div>
                                        <a href="{{ route('events.volunteer.create', $event->id) }}" 
                                           class="btn btn-light btn-lg shadow-sm">
                                            <i class="fas fa-user-plus me-2"></i>Mohon Sekarang
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endauth

                        @guest
                            @if($event->allow_volunteers)
                                <div class="modern-alert alert-info mt-4">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Log masuk</strong> untuk memohon sebagai sukarelawan bagi acara ini.
                                </div>
                            @endif
                        @endguest

                        <!-- Meta Footer -->
                        <hr class="my-4" style="border-top: 2px solid #e9ecef;">
                        <div class="text-muted small">
                            <i class="far fa-calendar-plus me-2"></i>
                            Diterbitkan: {{ $event->created_at->format('d M Y, h:i A') }}
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="text-center mt-4">
                    <a href="{{ route('events.index.public') }}" class="btn btn-modern-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Senarai Acara
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection