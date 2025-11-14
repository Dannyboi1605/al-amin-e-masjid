<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name', 'Masjid Al-Amin') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <style>
        body { margin: 0; font-family: sans-serif; background-color: #f8f9fa;
        /* --- TAMBAH INI UNTUK TEST LQUID GLASS --- */
        /* background-image: url('https://picsum.photos/1920/1080?random=2'); 
        background-attachment: fixed; Penting untuk nampak blur */
        background-size: cover;
        /* --- END TEST STYLE --- */ }
        .admin-sidebar { 
            width: 250px; 
/* --- FIX: GLASSMORHPISM STYLE --- */
        background-color: rgba(52, 58, 64, 0.85); /* Darker, 85% opacity */
        backdrop-filter: blur(8px); /* Kunci untuk efek liquid glass */
        -webkit-backdrop-filter: blur(8px); /* Safari support */
        /* --- END FIX --- */
            min-height: 100vh; 
            padding-top: 20px;
        }
        .admin-main { flex-grow: 1; padding: 30px; }
        .admin-link { color: #adb5bd; text-decoration: none; display: block; padding: 8px 15px; }
        .admin-link:hover { background-color: #495057; color: white; }
    </style>
</head>
<body>

    <header style="background-color: #007bff; color: white; padding: 15px; box-shadow: 0 2px 4px rgba(0,0,0,.1);">
        <h3 style="margin: 0;">
            <a href="{{ route('admin.dashboard') }}" style="color: white; text-decoration: none;">Admin Panel Al-Amin e-Masjid</a>
        </h3>
    </header>

    <div style="display: flex;">
        <aside class="admin-sidebar">
            <h5 style="padding: 0 15px; color: #ced4da;">Menu Utama</h5>
            <ul style="list-style: none; padding: 0;">
                <li><a href="{{ route('admin.dashboard') }}" class="admin-link">Dashboard</a></li>
                <li><a href="{{ route('admin.users.index') }}" class="admin-link">Users</a></li>
                <li><a href="{{ route('admin.feedbacks.index') }}" class="admin-link">Feedbacks</a></li>
                <li><a href="{{ route('admin.donations.index') }}" class="admin-link">Donations</a></li>
                <li><a href="{{ route('admin.announcements.index') }}" class="admin-link">Announcements</a></li>
                <li><a href="{{ route('admin.events.index') }}" class="admin-link">Events</a></li>
                <li><a href="{{ route('admin.volunteers.index') }}" class="admin-link">Volunteers</a></li>
                <li><a href="{{ route('admin.forums.index') }}" class="admin-link">Forums</a></li>
                <li><a href="{{ route('admin.about.index') }}" class="admin-link">About Us Management</a></li>
                <hr style="border-color: #495057;">
                <li><a href="{{ route('homepage') }}" class="admin-link">Dashboard Utama</a></li>
            </ul>
        </aside>

        <main class="admin-main">
            @yield('content') {{-- <--- SEMUA KOD ADMIN VIEW AKAN DIPAPARKAN DI SINI --}}
        </main>
    </div>

</body>
</html>