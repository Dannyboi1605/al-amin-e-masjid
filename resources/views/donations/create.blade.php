@extends('layouts.app') 

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
@section('content')
<div class="container my-5">
    
    <h1 class="mb-4 text-center">Infaq & Derma Online</h1>
    <p class="text-center text-muted">Sumbangan anda akan disalurkan terus kepada pengurusan Masjid Al-Amin.</p>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <div class="card shadow-lg mx-auto" style="max-width: 500px;">
        <div class="card-body p-4">
            
            <form method="POST" action="{{ route('donation.store') }}">
                @csrf
                
                {{-- Nama Penderma --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Penuh:</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Emel (Untuk Resit):</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                {{-- Phone Number --}}
                <div class="mb-3">
                    <label for="phone" class="form-label">Nombor Telefon:</label>
                    <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" required>
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <hr>

                {{-- Amaun --}}
                <div class="mb-4">
                    <label for="amount" class="form-label fs-5">Amaun Derma (RM):</label>
                    <div class="input-group">
                        <span class="input-group-text">RM</span>
                        <input type="number" id="amount" name="amount" class="form-control form-control-lg @error('amount') is-invalid @enderror" min="1" required placeholder="Cth: 50.00">
                        @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                
                <button type="submit" class="btn btn-success btn-lg w-100">
                    Sumbang Sekarang & Teruskan ke Pembayaran
                </button>
            </form>

        </div>
    </div>
</div>
@endsection