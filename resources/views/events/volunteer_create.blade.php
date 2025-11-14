@extends('layouts.app')

@section('content')
<!-- ===========================
     VOLUNTEER APPLICATION FORM
     User applies to volunteer
=========================== -->

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-hands-helping me-2"></i>Mohon Jadi Sukarelawan</h1>
        <p class="mb-0">{{ $event->title }}</p>
    </div>
</div>

<!-- Main Content Section -->
<div class="content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                
                <!-- Application Form Card -->
                <div class="modern-card">
                    <div class="card-body">
                        
                        <!-- Form Icon -->
                        <div class="icon-circle mx-auto mb-4">
                            <i class="fas fa-user-plus"></i>
                        </div>

                        <!-- Event Summary -->
                        <div class="p-3 mb-4" style="background: #f8f9fa; border-radius: 10px; border-left: 4px solid #667eea;">
                            <h5 class="fw-bold mb-2">Butiran Acara</h5>
                            <p class="mb-1">
                                <i class="fas fa-calendar-alt me-2"></i>
                                <strong>Tarikh:</strong> {{ $event->date->format('d M Y') }}
                            </p>
                            <p class="mb-1">
                                <i class="far fa-clock me-2"></i>
                                <strong>Masa:</strong> {{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}
                            </p>
                            <p class="mb-0">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <strong>Lokasi:</strong> {{ $event->location }}
                            </p>
                        </div>

                        <!-- Volunteer Application Form -->
                        <form action="{{ route('events.volunteer.store', $event->id) }}" method="POST" class="modern-form">
                            @csrf

                            <!-- Message Field -->
                            <div class="mb-4">
                                <label for="message" class="form-label fw-bold">
                                    <i class="fas fa-comment-dots me-2"></i>Mesej Kepada Pentadbir (Pilihan)
                                </label>
                                <textarea name="message" 
                                          id="message" 
                                          class="form-control" 
                                          rows="5" 
                                          placeholder="Beritahu kami mengapa anda ingin menjadi sukarelawan untuk acara ini...">{{ old('message') }}</textarea>
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Kongsi pengalaman atau kemahiran yang berkaitan
                                </small>
                            </div>

                            <!-- Information Notice -->
                            <div class="modern-alert alert-info mb-4">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                Permohonan anda akan disemak oleh pentadbir. Anda akan menerima notifikasi email apabila permohonan anda diluluskan atau ditolak.
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-3 justify-content-center">
                                <button type="submit" class="btn btn-modern-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Hantar Permohonan
                                </button>
                                <a href="{{ route('events.show.public', $event->id) }}" class="btn btn-modern-secondary btn-lg">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

