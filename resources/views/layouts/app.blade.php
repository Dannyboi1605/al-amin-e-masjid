<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Masjid Al-Amin FYP') }}</title>

    <!-- 1. BOOTSTRAP CSS (WAJIB UNTUK STYLING NAVBAR) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome (Untuk Icons Derma/Admin) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH57XJzIrfch1Y5yQ5kK33bA2F1D0A3v1k1u6D8w0C5V5D2VvP90/r7Q9Fz5J0/sN01B05jV5P5+S2/n5+w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts (Jika anda guna Vite untuk compile custom CSS/JS) -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    
    <!-- Custom Glassmorphism Styles -->
    <style>
        /* ===========================
           GLASSMORPHISM NAVBAR
        =========================== */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .navbar-glass {
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-glass .navbar-brand {
            color: white !important;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        .navbar-glass .navbar-brand:hover {
            transform: translateY(-2px);
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        /* Logo Image Sizing (ADJUST HERE) */
        .navbar-brand-logo {
            height: 60px;           /* Change this value to make logo bigger/smaller */
            width: auto;            /* Maintains aspect ratio */
            display: block;
        }
        
        /* Mobile: Smaller logo */
        @media (max-width: 576px) {
            .navbar-brand-logo { 
                height: 40px;       /* Smaller on mobile screens */
            }
        }
        
        .navbar-glass .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 0 4px;
        }
        
        .navbar-glass .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
            transform: translateY(-2px);
        }
        
        .navbar-glass .btn-success {
            background: rgba(40, 167, 69, 0.9) !important;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .navbar-glass .btn-success:hover {
            background: rgba(40, 167, 69, 1) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
        }
        
        .navbar-glass .btn-outline-light {
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: white !important;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .navbar-glass .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: white;
            transform: translateY(-2px);
        }
        
        .navbar-glass .btn-outline-primary {
            border: 1px solid rgba(13, 110, 253, 0.8);
            color: white !important;
            background: rgba(13, 110, 253, 0.3);
            backdrop-filter: blur(10px);
        }
        
        .navbar-glass .btn-outline-primary:hover {
            background: rgba(13, 110, 253, 0.8);
            border-color: #0d6efd;
        }
        
        .navbar-glass .btn-primary {
            background: rgba(13, 110, 253, 0.9) !important;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .navbar-glass .btn-primary:hover {
            background: rgba(13, 110, 253, 1) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.4);
        }
        
        .navbar-glass .text-warning {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .navbar-glass .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        
        .navbar-glass .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.1);
        }
        
        .navbar-glass .navbar-toggler-icon {
            filter: brightness(0) invert(1);
        }
        
        /* ===========================
           PRAYER TIMES BAR
        =========================== */
        .prayer-times-bar {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: top;
            top: 56px;
            z-index: 999;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }
        
        .prayer-time-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 8px;
            padding: 8px 16px;
            margin: 4px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .prayer-time-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .prayer-time-item .prayer-name {
            font-size: 0.85rem;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .prayer-time-item .prayer-time {
            font-size: 1rem;
            font-weight: 700;
            margin-top: 2px;
        }
        
        /* Main content background fix */
        main {
            background: white;
            min-height: calc(100vh - 150px);
        }

        /* ===========================
           HOMEPAGE HERO SECTION
        =========================== */
        .hero-section {
            position: relative;
            height: 90vh;
            min-height: 500px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?w=1200') center/cover;
            opacity: 0.3;
            z-index: 1;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 0 20px;
        }
        
        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }
        
        .hero-cta {
            display: inline-block;
            padding: 15px 40px;
            background: white;
            color: #667eea;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .hero-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            color: #764ba2;
        }

        /* ===========================
           PARALLAX SECTION
        =========================== */
        .parallax-section {
            height: 400px;
            background-image: url('https://images.unsplash.com/photo-1564769625905-50e93615e769?w=1200');
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        }
        
        .parallax-content {
            text-align: center;
            background: rgba(0,0,0,0.5);
            padding: 40px;
            border-radius: 10px;
        }

        /* ===========================
           THUMBNAIL GRID SECTION
        =========================== */
        .thumbnail-section {
            padding: 80px 0;
            background: #f8f9fa;
        }
        
        .thumbnail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .thumbnail-card {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            cursor: pointer;
            height: 350px;
            text-decoration: none;
            color: inherit;
        }
        
        .thumbnail-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        
        .thumbnail-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .thumbnail-card:hover img {
            transform: scale(1.1);
        }
        
        .thumbnail-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            color: white;
            padding: 30px 20px;
            transform: translateY(10px);
            transition: transform 0.3s ease;
        }
        
        .thumbnail-card:hover .thumbnail-overlay {
            transform: translateY(0);
        }

        /* ===========================
           FULL-WIDTH BANNER
        =========================== */
        .banner-section {
            height: 300px;
            background-image: url('https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=1200');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        }

        /* ===========================
           CAROUSEL SLIDER
        =========================== */
        .carousel-section {
            padding: 80px 0;
            background: white;
        }
        
        .carousel-container {
            position: relative;
            max-width: 1000px;
            margin: 0 auto;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .carousel-slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        
        .carousel-slide {
            min-width: 100%;
            height: 500px;
        }
        
        .carousel-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.8);
            border: none;
            font-size: 2rem;
            padding: 15px 20px;
            cursor: pointer;
            transition: background 0.3s ease;
            z-index: 10;
            border-radius: 5px;
        }
        
        .carousel-arrow:hover {
            background: rgba(255,255,255,1);
        }
        
        .carousel-arrow.prev {
            left: 20px;
        }
        
        .carousel-arrow.next {
            right: 20px;
        }
        
        .carousel-indicators {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }
        
        .carousel-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .carousel-indicator.active {
            background: white;
        }

        /* ===========================
           LEAD MAGNET / SUBSCRIBE
        =========================== */
        .subscribe-form {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        .subscribe-form input {
            flex: 1;
            padding: 15px 20px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
        }
        .subscribe-form button {
            padding: 12px 24px;
            border-radius: 50px;
            background: white;
            color: #667eea;
            font-weight: 600;
            border: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }
        .subscribe-form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* ===========================
           FOOTER
        =========================== */
        .footer-section {
            background: #2d3748;
            color: white;
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            opacity: 0.9;
        }
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }
        .footer-links a {
            color: #e2e8f0;
            text-decoration: none;
        }
        .footer-links a:hover {
            color: #667eea;
        }
        .footer-copyright {
            margin-top: 15px;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* ===========================
           MODERN PAGE STYLES
        =========================== */
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 0;
            margin-bottom: 50px;
            color: white;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .page-header p {
            font-size: 1.1rem;
            opacity: 0.95;
        }

        .modern-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: none;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }

        .modern-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .modern-card .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            padding: 20px;
            border: none;
        }

        .modern-card .card-body {
            padding: 30px;
        }

        .modern-card .list-group-item {
            border-left: none;
            border-right: none;
            padding: 15px 20px;
            transition: background 0.2s ease;
        }

        .modern-card .list-group-item:hover {
            background: #f8f9fa;
        }

        .modern-card .list-group-item:first-child {
            border-top: none;
        }

        .modern-card .list-group-item:last-child {
            border-bottom: none;
        }

        /* Modern Form Styles */
        .modern-form .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .modern-form .form-control,
        .modern-form .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .modern-form .form-control:focus,
        .modern-form .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .modern-form textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        /* Modern Button Styles */
        .btn-modern-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-modern-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-modern-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-modern-secondary:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        /* Filter Button Group */
        .filter-group .btn {
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        /* Badge Styles */
        .modern-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Alert Styles */
        .modern-alert {
            border-radius: 15px;
            border: none;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .modern-alert.alert-success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }

        .modern-alert.alert-info {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            color: white;
        }

        .modern-alert.alert-danger {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
        }

        /* Icon Styles */
        .icon-circle {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        /* Content Section */
        .content-section {
            background: white;
            padding: 50px 0;
            min-height: 60vh;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .prayer-times-bar {
                top: 0;
            }
            
            .prayer-time-item {
                font-size: 0.85rem;
                padding: 6px 10px;
                margin: 2px;
            }
            
            .prayer-time-item .prayer-name {
                font-size: 0.75rem;
            }
            
            .prayer-time-item .prayer-time {
                font-size: 0.9rem;
            }

            .hero-content h1 {
                font-size: 2.0rem;
            }
            
            .hero-content p {
                font-size: 1.1rem;
            }
            
            .thumbnail-grid {
                grid-template-columns: 1fr;
                padding: 0 20px;
            }
            
            .subscribe-form {
                flex-direction: column;
            }
            
            .carousel-slide {
                height: 300px;
            }
            
            .carousel-arrow {
                font-size: 1.5rem;
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>

    {{-- ============================== --}}
    {{-- 1. NAVIGATION BAR (HEADER) --}}
    {{-- ============================== --}}
    <nav class="navbar navbar-expand-lg navbar-glass" aria-label="Laman Navigasi Utama">
        <div class="container-fluid container">
            
            {{-- Brand Logo (links to homepage) --}}
            <a class="navbar-brand d-flex align-items-center" href="{{ route('homepage') }}" aria-label="Halaman Utama">
                <img src="{{ asset('\img\logo_maas.png') }}" alt="Logo Masjid Al-Amin" class="navbar-brand-logo me-2" />
                <span class="visually-hidden">Masjid Al-Amin Kampung Serigai Putatan</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- PUBLIC LINKS --}}
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('homepage') ? 'active' : '' }}" href="{{ route('homepage') }}">Utama</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about.*') ? 'active' : '' }}" href="{{ route('about.index') }}">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('prayer.*') ? 'active' : '' }}" href="{{ route('prayer.index') }}">Waktu Solat</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('announcements.*') ? 'active' : '' }}" href="{{ route('announcements.index.public') }}">Pengumuman</a></li>
                    
                    {{-- Program Komuniti (with optional dropdown for future subpages) --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('events.*') ? 'active' : '' }}" href="{{ route('events.index.public') }}" id="programDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Program Komuniti
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="programDropdown">
                            <li><a class="dropdown-item" href="{{ route('events.index.public') }}">Semua Acara</a></li>
                            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['filter' => 'upcoming']) }}">Acara Akan Datang</a></li>
                            <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['filter' => 'past']) }}">Acara Lepas</a></li>
                        </ul>
                    </li>
                     
                </ul>

                {{-- KEY ACTIONS & AUTH (Kanan) --}}
                <ul class="navbar-nav ms-auto">
                    {{-- MODUL ACTIONS --}}
                    <li class="nav-item me-3 d-flex align-items-center">
                        <a class="btn btn-success btn-sm" href="{{ route('donation.create') }}">
                            <i class="fas fa-hand-holding-usd"></i> Derma Online
                        </a>
                    </li>
                    <li class="nav-item me-3 d-flex align-items-center">
                        <a class="btn btn-outline-light btn-sm" href="{{ route('feedback.create') }}">
                            Hantar Feedback
                        </a>
                    </li>

                    {{-- AUTHENTICATION LINKS --}}
                    @guest
                        <li class="nav-item"><a class="btn btn-outline-primary btn-sm me-2" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="btn btn-primary btn-sm" href="{{ route('register') }}">Register</a></li>
                    @else
                        {{-- ADMIN LINK (Hanya jika role=admin) --}}
                        @if (Auth::user()->role === 'admin')
                            <li class="nav-item me-3">
                                <a class="nav-link text-warning fw-bold" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-user-shield"></i> ADMIN PANEL
                                </a>
                            </li>
                        @endif
                        
                        {{-- USER DROPDOWN --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('homepage') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    
    {{-- ============================== --}}
    {{-- PRAYER TIMES BAR --}}
    {{-- ============================== --}}
    <div class="prayer-times-bar py-3">
        <div class="container">
            <div class="row justify-content-center text-center g-2">
                @foreach($prayerTimesList as $prayerName => $prayerTime)
                    <div class="col-auto">
                        <div class="prayer-time-item text-white">
                            <div class="prayer-name">{{ $prayerName }}</div>
                            <div class="prayer-time">{{ date('h:i A', $prayerTime) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
    {{-- ============================== --}}
    {{-- 2. MAIN CONTENT AREA --}}
    {{-- ============================== --}}
    <main> 
        @yield('content')
    </main>

    {{-- ============================== --}}
    {{-- 3. JAVASCRIPT (WAJIB LETAK DI BAWAH) --}}
    {{-- ============================== --}}
    <!-- WAJIB UNTUK DROPDOWN & MOBILE TOGGLER -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>