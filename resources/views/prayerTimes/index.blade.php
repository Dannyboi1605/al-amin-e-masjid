@extends('layouts.app') 

@section('content')
<!-- ===========================
     PRAYER TIMES PAGE
     Modern design with gradient header and card layout
=========================== -->

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-mosque me-2"></i>Jadual Waktu Solat Harian</h1>
        <p class="mb-0">Zon Waktu: SBH07 | Tarikh Hari Ini: {{ date('d M Y, l') }}</p>
    </div>
</div>

<!-- Main Content Section -->
<div class="content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                
                <!-- Prayer Times Card -->
                <div class="modern-card">
                    <div class="card-header">
                        <i class="fas fa-clock me-2"></i>Waktu Solat Utama
                    </div>
                    <ul class="list-group list-group-flush">
                        {{-- Loop through prayer times data from View Composer --}}
                        @if(isset($prayerTimesList))
                            @foreach($prayerTimesList as $prayerName => $prayerTime)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-prayer-hands me-2 text-primary"></i>
                                    <span class="fw-bold">{{ $prayerName }}</span>
                                </div>
                                <span class="fs-5 modern-badge" 
                                    data-timestamp="{{ $prayerTime }}">
                                    {{ date('h:i A', $prayerTime) }}
                                </span>
                            </li>
                            @endforeach
                        @else
                            <li class="list-group-item text-center">
                                <div class="modern-alert alert-danger">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    Data waktu solat tidak dapat dimuatkan.
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>

                {{-- Additional Actions --}}
                <div class="mt-4 text-center">
                    <a href="#" class="btn btn-modern-secondary">
                        <i class="fas fa-calendar-alt me-2"></i>Lihat Kalendar Bulanan
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Interactive Features -->
<script>
    // Highlight current prayer time
    document.addEventListener('DOMContentLoaded', function() {
        const now = Math.floor(Date.now() / 1000);
        const timeElements = document.querySelectorAll('[data-timestamp]');
        
        timeElements.forEach((el, index) => {
            const timestamp = parseInt(el.getAttribute('data-timestamp'));
            const listItem = el.closest('.list-group-item');
            
            // Check if current time is near this prayer time (within 30 minutes)
            if (Math.abs(now - timestamp) < 1800) {
                listItem.style.background = 'linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%)';
                listItem.style.borderLeft = '4px solid #667eea';
            }
        });
    });
</script>
@endsection