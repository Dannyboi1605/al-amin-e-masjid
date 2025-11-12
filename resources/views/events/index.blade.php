@extends('layouts.app') 

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-primary text-center">Acara Terkini</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Filter links: upcoming / past --}}
            <div class="d-flex justify-content-end mb-3">
                <div class="btn-group" role="group" aria-label="Filter events">
                    <a href="{{ route('events.index.public', ['filter' => 'upcoming']) }}" class="btn btn-sm {{ (isset($filter) && $filter === 'upcoming') || !isset($filter) ? 'btn-primary' : 'btn-outline-primary' }}">Akan Datang</a>
                    <a href="{{ route('events.index.public', ['filter' => 'past']) }}" class="btn btn-sm {{ isset($filter) && $filter === 'past' ? 'btn-primary' : 'btn-outline-primary' }}">Lepas</a>
                </div>
            </div>

            @foreach($events as $event)
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">

                    <h2 class="card-title fw-bold text-dark mb-1">{{ $event->title }}</h2>

                    <p class="text-muted small mb-3">
                        <i class="far fa-calendar-alt me-1"></i> Diterbitkan: {{ $event->created_at->format('d M Y, h:i A') }}
                    </p>

                    <p class="card-text">{{ Str::limit($event->description, 150, '...') }}</p>

                    {{-- Link ke Detail Page --}}
                    <a href="{{ route('events.show.public', $event->id) }}" class="btn btn-sm btn-outline-primary mt-2">
                        Baca Lanjut <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
            
            @if($events->isEmpty())
                <div class="alert alert-info text-center" role="alert">
                    Tiada acara aktif buat masa ini.
                </div>
            @endif

        </div>
    </div>
</div>
@endsection