@extends('layouts.app') 

@section('content')
<!-- ===========================
     DONATION FORM PAGE
     Online donation submission
=========================== -->

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-hand-holding-heart me-2"></i>Infaq & Derma Online</h1>
        <p class="mb-0">Sumbangan anda akan disalurkan terus kepada pengurusan Masjid Al-Amin</p>
    </div>
</div>

<!-- Main Content Section -->
<div class="content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                
                <!-- Error Alert -->
                @if (session('error'))
                    <div class="modern-alert alert-danger mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                    </div>
                @endif
                
                <!-- Donation Form Card -->
                <div class="modern-card">
                    <div class="card-body">
                        
                        <!-- Form Icon -->
                        <div class="icon-circle mx-auto mb-4">
                            <i class="fas fa-mosque"></i>
                        </div>

                        <!-- Information Banner -->
                        <div class="p-3 mb-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; color: white; text-align: center;">
                            <i class="fas fa-shield-alt me-2"></i>
                            <strong>Selamat & Terjamin</strong>
                            <p class="mb-0 small mt-1 opacity-90">Semua transaksi diproses dengan selamat</p>
                        </div>

                        <!-- Donation Form -->
                        <form method="POST" action="{{ route('donation.store') }}" class="modern-form">
                            @csrf
                            
                            <!-- Donor Information Section -->
                            <h5 class="fw-bold mb-3">
                                <i class="fas fa-user-circle me-2"></i>Maklumat Penderma
                            </h5>

                            {{-- Name Field --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user me-2"></i>Nama Penuh:
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       placeholder="Masukkan nama penuh anda"
                                       value="{{ old('name') }}"
                                       required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            {{-- Email Field --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Alamat Emel (Untuk Resit):
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       placeholder="contoh@email.com"
                                       value="{{ old('email') }}"
                                       required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>Resit akan dihantar ke emel ini
                                </small>
                            </div>
                            
                            {{-- Phone Field --}}
                            <div class="mb-4">
                                <label for="phone" class="form-label">
                                    <i class="fas fa-phone me-2"></i>Nombor Telefon:
                                </label>
                                <input type="text" 
                                       id="phone" 
                                       name="phone" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       placeholder="012-3456789"
                                       value="{{ old('phone') }}"
                                       required>
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <!-- Divider -->
                            <hr class="my-4" style="border-top: 2px solid #e9ecef;">

                            <!-- Donation Amount Section -->
                            <h5 class="fw-bold mb-3">
                                <i class="fas fa-coins me-2"></i>Jumlah Sumbangan
                            </h5>

                            {{-- Amount Field --}}
                            <div class="mb-4">
                                <label for="amount" class="form-label fs-5">Amaun Derma (RM):</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-white" style="border: 2px solid #e9ecef;">
                                        <i class="fas fa-money-bill-wave me-2"></i>RM
                                    </span>
                                    <input type="number" 
                                           id="amount" 
                                           name="amount" 
                                           class="form-control @error('amount') is-invalid @enderror" 
                                           min="1" 
                                           step="0.01"
                                           placeholder="50.00"
                                           value="{{ old('amount') }}"
                                           style="border: 2px solid #e9ecef; font-weight: bold; font-size: 1.2rem;"
                                           required>
                                    @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>Minimum RM 1.00
                                </small>
                            </div>

                            <!-- Information Notice -->
                            <div class="modern-alert alert-success mb-4">
                                <i class="fas fa-heart me-2"></i>
                                <strong>Jazakallahu Khairan!</strong> Terima kasih atas sumbangan ikhlas anda untuk pembangunan dan pengurusan masjid.
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-modern-primary btn-lg w-100">
                                <i class="fas fa-credit-card me-2"></i>Teruskan ke Pembayaran
                            </button>
                        </form>

                    </div>
                </div>

                <!-- Security Notice -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        <i class="fas fa-lock me-2"></i>
                        Maklumat anda dilindungi dengan teknologi enkripsi SSL
                    </small>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection