@extends('layouts.app') 

@section('content')
<!-- ===========================
     FEEDBACK FORM PAGE
     User feedback submission
=========================== -->

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-comments me-2"></i>Maklum Balas & Cadangan</h1>
        <p class="mb-0">Suara anda penting untuk kami. Kongsi pandangan anda dengan pengurusan masjid.</p>
    </div>
</div>

<!-- Main Content Section -->
<div class="content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                
                <!-- Success Message -->
                @if (session('success'))
                    <div class="modern-alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <!-- Feedback Form Card -->
                <div class="modern-card">
                    <div class="card-body">
                        
                        <!-- Form Icon -->
                        <div class="icon-circle mx-auto mb-4">
                            <i class="fas fa-comment-dots"></i>
                        </div>

                        <!-- Information Banner -->
                        <div class="p-3 mb-4" style="background: #f8f9fa; border-radius: 10px; border-left: 4px solid #667eea;">
                            <h6 class="fw-bold mb-2">
                                <i class="fas fa-info-circle me-2"></i>Tentang Maklum Balas Anda
                            </h6>
                            <small class="text-muted">
                                Maklum balas anda akan dihantar terus kepada pengurusan masjid. Kami menghargai cadangan, aduan, atau pujian anda untuk membantu kami meningkatkan perkhidmatan.
                            </small>
                        </div>

                        <!-- Feedback Form -->
                        <form method="POST" action="{{ route('feedback.store') }}" class="modern-form">
                            @csrf
                            
                            <!-- User Information Display -->
                            @auth
                                <div class="p-3 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; color: white;">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle me-3" style="background: white; color: #667eea;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-bold">{{ Auth::user()->name }}</p>
                                            <small class="opacity-90">{{ Auth::user()->email }}</small>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                            @endauth

                            {{-- Message Field --}}
                            <div class="mb-4">
                                <label for="message" class="form-label fw-bold">
                                    <i class="fas fa-pen me-2"></i>Mesej Anda (Wajib):
                                </label>
                                <textarea id="message" 
                                          name="message" 
                                          class="form-control @error('message') is-invalid @enderror" 
                                          rows="6" 
                                          placeholder="Kongsi pendapat, cadangan, atau aduan anda di sini..."
                                          required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Minimum 10 aksara
                                </small>
                            </div>

                            {{-- Email Field for Guests --}}
                            @guest
                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold">
                                    <i class="fas fa-envelope me-2"></i>Emel Anda (Pilihan):
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="nama@example.com"
                                       value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Berikan emel jika anda mahu follow-up
                                </small>
                            </div>
                            @endguest
                            
                            {{-- Anonymity Checkbox --}}
                            <div class="mb-4">
                                <div class="form-check p-3" style="background: #f8f9fa; border-radius: 10px;">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="is_anonymous" 
                                           name="is_anonymous" 
                                           value="1"
                                           style="width: 20px; height: 20px; cursor: pointer;">
                                    <label class="form-check-label ms-2" for="is_anonymous" style="cursor: pointer;">
                                        <i class="fas fa-user-secret me-2"></i>
                                        <strong>Hantar Secara Anonim</strong>
                                        <br>
                                        <small class="text-muted">Pihak pengurusan tidak dapat mengenal pasti anda atau membuat follow-up</small>
                                    </label>
                                </div>
                            </div>

                            <!-- Information Notice -->
                            <div class="modern-alert alert-info mb-4">
                                <i class="fas fa-lock me-2"></i>
                                Privasi anda dilindungi. Maklumat hanya akan digunakan untuk tujuan komunikasi dengan pengurusan masjid sahaja.
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-modern-primary btn-lg w-100">
                                <i class="fas fa-paper-plane me-2"></i>Hantar Maklum Balas
                            </button>
                        </form>

                    </div>
                </div>

                <!-- Help Text -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        <i class="fas fa-question-circle me-2"></i>
                        Maklum balas anda membantu kami meningkatkan perkhidmatan masjid
                    </small>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection