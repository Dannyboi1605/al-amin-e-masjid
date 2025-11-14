@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Lihat Acara</h1>
        <div>
            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-warning me-2"><i class="fas fa-pencil-alt"></i> Edit</a>
            <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-secondary">Back to list</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h2>{{ $event->title }}</h2>
            <p class="text-muted small">
                <i class="fas fa-calendar-day me-1"></i> Tarikh acara: {{ $event->date->format('d M Y') }}
                &nbsp; · &nbsp;
                <i class="fas fa-map-marker-alt me-1"></i> Lokasi: {{ $event->location }}
            </p>

            <hr>

            <div class="mb-3">
                {!! nl2br(e($event->description)) !!}
            </div>

            <p class="text-muted small">Created: {{ $event->created_at->format('d M Y H:i') }} | Updated: {{ $event->updated_at->format('d M Y H:i') }}</p>
        </div>
    </div>
</div>
@endsection
