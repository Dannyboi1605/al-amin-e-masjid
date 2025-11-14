@extends('layouts.app')

@section('content')
<!-- ===========================
     DONATION SUCCESS PAGE
     Confirmation after payment
=========================== -->

<!-- Page Header -->
<div class="page-header" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
    <div class="container text-center">
        <div class="icon-circle mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem; background: white; color: #11998e;">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1 class="text-white"><i class="fas fa-heart me-2"></i>Terima Kasih!</h1>
        <p class="mb-0 text-white opacity-90">Sumbangan anda telah berjaya diterima</p>
    </div>
</div>

<!-- Main Content Section -->
<div class="content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                
                <!-- Success Message Card -->
                <div class="modern-card">
                    <div class="card-body text-center">
                        
                        <!-- Success Icon -->
                        <div class="icon-circle mx-auto mb-4" style="width: 100px; height: 100px; font-size: 3rem; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white;">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>

                        <!-- Main Message -->
                        <h2 class="fw-bold mb-3">Jazakallahu Khairan!</h2>
                        <p class="fs-5 mb-4" style="line-height: 1.8; color: #555;">
                            Derma anda telah berjaya diproses. Terima kasih atas sokongan dan sumbangan ikhlas anda untuk pembangunan Masjid Al-Amin.
                        </p>

                        <!-- Divider -->
                        <hr class="my-4" style="border-top: 2px solid #e9ecef;">

                        <!-- Information Boxes -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="p-3" style="background: #f8f9fa; border-radius: 10px;">
                                    <i class="fas fa-envelope text-primary fs-3 mb-2"></i>
                                    <p class="mb-0 small fw-bold">Resit Emel</p>
                                    <small class="text-muted">Akan dihantar tidak lama lagi</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3" style="background: #f8f9fa; border-radius: 10px;">
                                    <i class="fas fa-shield-alt text-success fs-3 mb-2"></i>
                                    <p class="mb-0 small fw-bold">Selamat & Terjamin</p>
                                    <small class="text-muted">Transaksi dilindungi</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3" style="background: #f8f9fa; border-radius: 10px;">
                                    <i class="fas fa-mosque text-info fs-3 mb-2"></i>
                                    <p class="mb-0 small fw-bold">Dana Masjid</p>
                                    <small class="text-muted">Diuruskan dengan amanah</small>
                                </div>
                            </div>
                        </div>

                        <!-- Thank You Message -->
                        <div class="modern-alert alert-success">
                            <i class="fas fa-star me-2"></i>
                            Semoga Allah memberkati sumbangan anda dan memudahkan segala urusan anda.
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 justify-content-center mt-4">
                            <a href="{{ route('homepage') }}" class="btn btn-modern-primary btn-lg">
                                <i class="fas fa-home me-2"></i>Kembali ke Halaman Utama
                            </a>
                            <a href="{{ route('donation.create') }}" class="btn btn-modern-secondary btn-lg">
                                <i class="fas fa-hand-holding-heart me-2"></i>Sumbang Lagi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Social Sharing (Optional) -->
                <div class="text-center mt-4">
                    <p class="text-muted mb-2">
                        <i class="fas fa-share-alt me-2"></i>Ajak rakan-rakan anda untuk menyumbang juga
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection