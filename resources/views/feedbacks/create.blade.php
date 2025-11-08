@extends('layouts.app') 

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
@section('content')
<div class="container my-5">
    
    <h1 class="mb-4">Hantar Maklum Balas Kepada Pengurusan</h1>
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="card shadow-sm">
        <div class="card-body">
            
            <form method="POST" action="{{ route('feedback.store') }}">
                @csrf
                
                {{-- MESSAGE FIELD --}}
                <div class="mb-3">
                    <label for="message" class="form-label">Mesej Anda (Wajib):</label>
                    <textarea id="message" name="message" class="form-control @error('message') is-invalid @enderror" rows="5" required></textarea>
                    @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- EMAIL FIELD (Conditional based on login status) --}}
                @guest
                <div class="mb-3">
                    <label for="email" class="form-label">Emel Anda (Pilihan, untuk Follow-up):</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @else
                {{-- Jika user login, kita sembunyikan field email --}}
                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                <p class="text-muted small">Anda *logged in* sebagai **{{ Auth::user()->name }}**. Emel anda akan digunakan untuk follow-up melainkan anda pilih Anonim.</p>
                @endguest
                
                {{-- ANONYMITY CHECKBOX --}}
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="is_anonymous" name="is_anonymous" value="1">
                    <label class="form-check-label" for="is_anonymous">
                        **Hantar Secara Anonim** (Pihak pengurusan tidak dapat follow-up)
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Hantar Maklum Balas</button>
            </form>

        </div>
    </div>
</div>
@endsection