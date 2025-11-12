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
</head>
<body>

    {{-- ============================== --}}
    {{-- 1. NAVIGATION BAR (HEADER) --}}
    {{-- ============================== --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid container">
            
            <a class="navbar-brand" href="{{ route('homepage') }}">
                <i class="fas fa-mosque me-2"></i>Masjid Al-Amin Kampung Serigai Putatan
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- PUBLIC LINKS --}}
                    <li class="nav-item"><a class="nav-link" href="{{ route('homepage') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('prayer.index') }}">Waktu Solat</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('announcements.index.public') }}">Pengumuman</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('events.index.public') }}">Acara</a></li>
                     
                </ul>

                {{-- KEY ACTIONS & AUTH (Kanan) --}}
                <ul class="navbar-nav ms-auto">
                    {{-- MODUL ACTIONS --}}
                    <li class="nav-item me-3">
                        <a class="btn btn-success btn-sm" href="{{ route('donation.create') }}">
                            <i class="fas fa-hand-holding-usd"></i> Derma Online
                        </a>
                    </li>
                    <li class="nav-item me-3">
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
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
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
    <div class="container-fluid bg-primary py-2">
    <div class="container">
        <div class="row justify-content-center text-center">
            @foreach($prayerTimesList as $prayerName => $prayerTime)
                <div class="col-auto text-white fw-bold mx-3">
                    {{ $prayerName }}: <span class="d-block">{{ date('h:i A', $prayerTime) }}</span>
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