@extends('layouts.app')

@section('content')
<!-- ===========================
     ABOUT US PAGE
     Tentang Kami - Public View
=========================== -->

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-mosque me-2"></i>Tentang Kami</h1>
        <p class="mb-0">Mengenali Masjid Al-Amin dan misinya dalam masyarakat</p>
    </div>
</div>

<!-- Main Content Section -->
<div class="content-section">
    <div class="container">

        @if($about)
            <!-- ==================
                 MASJID IMAGES GALLERY
                 ================== -->
            @if($about->images && count($about->images) > 0)
            <div class="modern-card mb-5">
                <div class="card-body">
                    <h3 class="fw-bold mb-4 text-center">
                        <i class="fas fa-images me-2"></i>Galeri Masjid
                    </h3>
                    
                    <!-- Image Grid -->
                    <div class="row g-3">
                        @foreach($about->images as $image)
                        <div class="col-md-4 col-sm-6">
                            <div class="image-container" style="position: relative; overflow: hidden; border-radius: 15px; height: 250px; cursor: pointer;" 
                                 onclick="openImageModal('{{ asset('storage/' . $image) }}')">
                                <img src="{{ asset('storage/' . $image) }}" 
                                     alt="Masjid Al-Amin" 
                                     class="img-fluid" 
                                     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                                <div class="image-overlay" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.3); opacity: 0; transition: opacity 0.3s ease; display: flex; align-items: center; justify-content: center; color: white;">
                                    <i class="fas fa-search-plus fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- ==================
                 VISION SECTION
                 ================== -->
            <div class="modern-card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center mb-3 mb-md-0">
                            <div class="icon-circle mx-auto" style="width: 80px; height: 80px; font-size: 2rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                <i class="fas fa-eye"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h3 class="fw-bold mb-3">
                                <i class="fas fa-eye me-2" style="color: #667eea;"></i>Visi Kami
                            </h3>
                            <p style="font-size: 1.1rem; line-height: 1.9; color: #333;">
                                {{ $about->vision }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================
                 MISSION SECTION
                 ================== -->
            <div class="modern-card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center mb-3 mb-md-0">
                            <div class="icon-circle mx-auto" style="width: 80px; height: 80px; font-size: 2rem; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white;">
                                <i class="fas fa-bullseye"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h3 class="fw-bold mb-3">
                                <i class="fas fa-bullseye me-2" style="color: #11998e;"></i>Misi Kami
                            </h3>
                            <p style="font-size: 1.1rem; line-height: 1.9; color: #333;">
                                {{ $about->mission }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================
                 OBJECTIVES SECTION
                 ================== -->
            <div class="modern-card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center mb-3 mb-md-0">
                            <div class="icon-circle mx-auto" style="width: 80px; height: 80px; font-size: 2rem; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                                <i class="fas fa-list-check"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h3 class="fw-bold mb-3">
                                <i class="fas fa-list-check me-2" style="color: #f5576c;"></i>Objektif Kami
                            </h3>
                            <div style="font-size: 1.1rem; line-height: 1.9; color: #333;">
                                {!! nl2br(e($about->objectives)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <!-- ==================
                 PLACEHOLDER CONTENT
                 When no about info exists yet
                 ================== -->
            
            <!-- Placeholder Images -->
            <div class="modern-card mb-5">
                <div class="card-body">
                    <h3 class="fw-bold mb-4 text-center">
                        <i class="fas fa-images me-2"></i>Galeri Masjid
                    </h3>
                    <div class="row g-3">
                        @for($i = 1; $i <= 3; $i++)
                        <div class="col-md-4">
                            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 250px; border-radius: 15px; display: flex; align-items: center; justify-content: center; color: white;">
                                <div class="text-center">
                                    <i class="fas fa-image fa-3x mb-2 opacity-50"></i>
                                    <p class="mb-0 opacity-75">Gambar {{ $i }}</p>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <div class="text-center mt-4">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-2"></i>
                            Gambar masjid akan dipaparkan di sini setelah pentadbir memuatnaik maklumat.
                        </small>
                    </div>
                </div>
            </div>

            <!-- Placeholder Vision -->
            <div class="modern-card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center mb-3 mb-md-0">
                            <div class="icon-circle mx-auto" style="width: 80px; height: 80px; font-size: 2rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                <i class="fas fa-eye"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h3 class="fw-bold mb-3">
                                <i class="fas fa-eye me-2" style="color: #667eea;"></i>Visi Kami
                            </h3>
                            <p style="font-size: 1.1rem; line-height: 1.9; color: #666; font-style: italic;">
                                Menjadi pusat pengajian dan pembangunan ummah yang cemerlang, berakhlak mulia, dan berlandaskan al-Quran dan as-Sunnah untuk kesejahteraan masyarakat setempat dan global.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Placeholder Mission -->
            <div class="modern-card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center mb-3 mb-md-0">
                            <div class="icon-circle mx-auto" style="width: 80px; height: 80px; font-size: 2rem; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white;">
                                <i class="fas fa-bullseye"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h3 class="fw-bold mb-3">
                                <i class="fas fa-bullseye me-2" style="color: #11998e;"></i>Misi Kami
                            </h3>
                            <p style="font-size: 1.1rem; line-height: 1.9; color: #666; font-style: italic;">
                                Menyediakan kemudahan ibadah yang selesa, menganjurkan program dakwah dan pendidikan Islam, membina hubungan silaturrahim dalam kalangan jemaah, dan membantu golongan yang memerlukan melalui kegiatan kebajikan dan sosial.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Placeholder Objectives -->
            <div class="modern-card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center mb-3 mb-md-0">
                            <div class="icon-circle mx-auto" style="width: 80px; height: 80px; font-size: 2rem; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                                <i class="fas fa-list-check"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h3 class="fw-bold mb-3">
                                <i class="fas fa-list-check me-2" style="color: #f5576c;"></i>Objektif Kami
                            </h3>
                            <div style="font-size: 1.1rem; line-height: 1.9; color: #666; font-style: italic;">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-check-circle me-2" style="color: #f5576c;"></i>Memartabatkan syiar Islam dalam masyarakat</li>
                                    <li class="mb-2"><i class="fas fa-check-circle me-2" style="color: #f5576c;"></i>Menyediakan pendidikan agama untuk semua peringkat umur</li>
                                    <li class="mb-2"><i class="fas fa-check-circle me-2" style="color: #f5576c;"></i>Mengukuhkan ukhuwah Islamiah di kalangan jemaah</li>
                                    <li class="mb-2"><i class="fas fa-check-circle me-2" style="color: #f5576c;"></i>Menjaga dan memelihara masjid sebagai rumah Allah</li>
                                    <li class="mb-2"><i class="fas fa-check-circle me-2" style="color: #f5576c;"></i>Membantu golongan yang memerlukan dalam masyarakat</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Notice -->
            <div class="modern-alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Nota:</strong> Ini adalah kandungan contoh. Pentadbir boleh mengemaskini maklumat ini di panel pentadbiran.
            </div>
        @endif

    </div>
</div>

<!-- ==================
     IMAGE MODAL
     For viewing full-size images
     ================== -->
<div id="imageModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; align-items: center; justify-content: center;" onclick="closeImageModal()">
    <span style="position: absolute; top: 20px; right: 40px; color: white; font-size: 40px; cursor: pointer;">&times;</span>
    <img id="modalImage" src="" alt="Full size" style="max-width: 90%; max-height: 90%; border-radius: 10px;">
</div>

<!-- ==================
     JAVASCRIPT
     Image gallery functionality
     ================== -->
<script>
    // Open image in modal
    function openImageModal(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        modal.style.display = 'flex';
        modalImg.src = imageSrc;
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }

    // Close modal
    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto'; // Re-enable scrolling
    }

    // Image hover effect
    document.querySelectorAll('.image-container').forEach(container => {
        container.addEventListener('mouseenter', function() {
            this.querySelector('img').style.transform = 'scale(1.1)';
            this.querySelector('.image-overlay').style.opacity = '1';
        });
        
        container.addEventListener('mouseleave', function() {
            this.querySelector('img').style.transform = 'scale(1)';
            this.querySelector('.image-overlay').style.opacity = '0';
        });
    });

    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageModal();
        }
    });
</script>

<!-- ==================
     ADDITIONAL STYLES
     Page-specific styling
     ================== -->
<style>
    /* Responsive adjustments for mobile */
    @media (max-width: 768px) {
        .icon-circle {
            width: 60px !important;
            height: 60px !important;
            font-size: 1.5rem !important;
        }
        
        .image-container {
            height: 200px !important;
        }
    }
</style>

@endsection
