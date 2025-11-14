@extends('layouts.app') 

@section('content')
<!-- ===========================
     1. HERO SECTION
=========================== -->
<section class="hero-section">
    <div class="hero-content">
        <h1>Selamat Datang ke Al-Amin E-Masjid</h1>
        <p>Menghubungkan komuniti melalui iman, acara, dan perkhidmatan. Sertai kami dalam membina ummah yang lebih kuat dan bersatu.</p>
        <a href="{{ route('events.index.public') }}" class="hero-cta">Teroka Program Kami</a>
    </div>
</section>

<!-- ===========================
     2. PARALLAX SCROLLING SECTION
=========================== -->
<section class="parallax-section">
    <div class="parallax-content">
        <h2 style="font-size: 2.5rem; font-weight: 700;">Perkuatkan Iman Anda</h2>
        <p style="font-size: 1.2rem;">Alami pertumbuhan rohani melalui program komuniti kami</p>
    </div>
</section>

<!-- ===========================
     3. THUMBNAIL GRID SECTION (3 Images with Hover)
=========================== -->
<section class="thumbnail-section">
    <div class="container">
        <h2 class="text-center mb-5" style="font-size: 2.5rem; font-weight: 700; color: #2d3748;">Servis Kami</h2>
        <div class="thumbnail-grid">
<!-- Card 1: Prayer Times -->
<a href="{{ route('prayer.index') }}" class="thumbnail-card">
    <img src="https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?w=600" alt="Prayer Times">
    <div class="thumbnail-overlay">
        <h3 style="font-size: 1.5rem; font-weight: 600;">Waktu Solat</h3>
        <p>Dapatkan jadual solat harian yang tepat dan terkini</p>
    </div>
</a>

            
            <!-- Card 2: Events -->
            <a href="{{ route('events.index.public') }}" class="thumbnail-card">
                <img src="https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=600" alt="Community Events">
                <div class="thumbnail-overlay">
                    <h3 style="font-size: 1.5rem; font-weight: 600;">Program Komuniti</h3>
                    <p>Sertai program rohani dan pendidikan kami</p>
                </div>
            </a>
            
            <!-- Card 3: Forum -->
            <a href="{{ route('forums.index') }}" class="thumbnail-card">
                <img src="https://images.unsplash.com/photo-1531545514256-b1400bc00f31?w=600" alt="Forum Discussion">
                <div class="thumbnail-overlay">
                    <h3 style="font-size: 1.5rem; font-weight: 600;">Forum Perbincangan</h3>
                    <p>Berbincang dan berkongsi pandangan dengan komuniti</p>
                </div>
            </a>
            
            <!-- Card 4: Donations -->
            <a href="{{ route('donation.create') }}" class="thumbnail-card">
                <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=600" alt="Online Donations">
                <div class="thumbnail-overlay">
                    <h3 style="font-size: 1.5rem; font-weight: 600;">Derma Dalam Talian</h3>
                    <p>Sokong masjid kami dengan pemberian dalam talian yang selamat</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- ===========================
     4. FULL-WIDTH BANNER IMAGE
=========================== -->
<section class="banner-section">
    <div>
        <h2 style="font-size: 2.5rem; font-weight: 700;">Sertai Komuniti Kami yang Berkembang</h2>
        <p style="font-size: 1.2rem;">Lebih 1,000 ahli dan semakin bertambah</p>
    </div>
</section>

<!-- ===========================
     5. IMAGE CAROUSEL/SLIDER
=========================== -->
<section class="carousel-section">
    <div class="container">
        <h2 class="text-center mb-5" style="font-size: 2.5rem; font-weight: 700; color: #2d3748;">Latest Announcements</h2>
        <div class="carousel-container">
            <div class="carousel-slides" id="carouselSlides">
                <!-- Slide 1 -->
                <div class="carousel-slide">
                    <img src="https://images.unsplash.com/photo-1564769625905-50e93615e769?w=1000" alt="Announcement 1">
                </div>
                <!-- Slide 2 -->
                <div class="carousel-slide">
                    <img src="https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?w=1000" alt="Announcement 2">
                </div>
                <!-- Slide 3 -->
                <div class="carousel-slide">
                    <img src="https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=1000" alt="Announcement 3">
                </div>
                <!-- Slide 4 -->
                <div class="carousel-slide">
                    <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=1000" alt="Announcement 4">
                </div>
            </div>
            
            <!-- Navigation Arrows -->
            <button class="carousel-arrow prev" onclick="moveSlide(-1)">&#10094;</button>
            <button class="carousel-arrow next" onclick="moveSlide(1)">&#10095;</button>
            
            <!-- Indicators -->
            <div class="carousel-indicators" id="carouselIndicators"></div>
        </div>
    </div>
</section>


<!-- ===========================
     7. FOOTER SECTION
=========================== -->
<footer class="footer-section">
    <div class="container">
        <div class="footer-links">
            <a href="{{ route('homepage') }}">Utama</a>
            <a href="{{ route('prayer.index') }}">Waktu Solat</a>
            <a href="{{ route('events.index.public') }}">Program Komuniti</a>
            <a href="{{ route('announcements.index.public') }}">Pengumuman</a>
            <a href="{{ route('donation.create') }}">Derma</a>
            <a href="{{ route('feedback.create') }}">Hubungi</a>
        </div>
        <div class="footer-copyright">
            <p>&copy; {{ date('Y') }} Al-Amin E-Masjid Kampung Serigai Putatan. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- ===========================
     JAVASCRIPT FOR INTERACTIVITY
=========================== -->
<script>
    // ===========================
    // CAROUSEL FUNCTIONALITY
    // ===========================
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const totalSlides = slides.length;
    const indicatorsContainer = document.getElementById('carouselIndicators');
    
    // Create indicator dots
    for (let i = 0; i < totalSlides; i++) {
        const indicator = document.createElement('button');
        indicator.classList.add('carousel-indicator');
        if (i === 0) indicator.classList.add('active');
        indicator.onclick = () => goToSlide(i);
        indicatorsContainer.appendChild(indicator);
    }
    
    const indicators = document.querySelectorAll('.carousel-indicator');
    
    // Move to specific slide
    function goToSlide(n) {
        currentSlide = n;
        if (currentSlide >= totalSlides) currentSlide = 0;
        if (currentSlide < 0) currentSlide = totalSlides - 1;
        
        const offset = -currentSlide * 100;
        document.getElementById('carouselSlides').style.transform = `translateX(${offset}%)`;
        
        // Update indicators
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentSlide);
        });
    }
    
    // Move slide by direction (-1 or 1)
    function moveSlide(direction) {
        goToSlide(currentSlide + direction);
    }
    
    // Auto-play carousel every 5 seconds
    setInterval(() => {
        moveSlide(1);
    }, 5000);
    
    // ===========================
    // SUBSCRIBE FORM HANDLER
    // ===========================
    function handleSubscribe(event) {
        event.preventDefault();
        const email = event.target.querySelector('input[type="email"]').value;
        alert(`Thank you for subscribing with: ${email}\n\nYou will receive updates from Al-Amin E-Masjid.`);
        event.target.reset();
    }
    
    // ===========================
    // SMOOTH SCROLLING FOR LINKS
    // ===========================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // ===========================
    // PARALLAX EFFECT OPTIMIZATION
    // ===========================
    window.addEventListener('scroll', () => {
        const parallax = document.querySelector('.parallax-section');
        if (parallax) {
            const scrolled = window.pageYOffset;
            const parallaxOffset = parallax.offsetTop;
            const rate = (scrolled - parallaxOffset) * 0.5;
            parallax.style.backgroundPositionY = `${rate}px`;
        }
    });
</script>
@endsection