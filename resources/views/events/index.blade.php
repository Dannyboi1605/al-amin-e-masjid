@extends('layouts.app') 

@section('content')
<!-- ===========================
     EVENTS INDEX PAGE
     Event listing with filters
=========================== -->

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-calendar-alt me-2"></i>Acara Terkini</h1>
        <p class="mb-0">Sertai program dan aktiviti masjid kami</p>
    </div>
</div>

<!-- Main Content Section -->
<div class="content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- Filter and Sort Controls --}}
                <div class="modern-card mb-4">
                    <div class="card-body">
                        <div class="row align-items-center g-3">
                            
                            <!-- Filter Buttons -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold mb-2">
                                    <i class="fas fa-filter me-2"></i>Tapis Acara:
                                </label>
                                <div class="filter-group">
                                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'upcoming', 'sort' => request('sort')]) }}" 
                                       class="btn {{ (isset($filter) && $filter === 'upcoming') || !isset($filter) ? 'btn-modern-primary' : 'btn-outline-secondary' }}">
                                        Akan Datang
                                    </a>
                                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'past', 'sort' => request('sort')]) }}" 
                                       class="btn {{ isset($filter) && $filter === 'past' ? 'btn-modern-primary' : 'btn-outline-secondary' }}">
                                        Lepas
                                    </a>
                                    <a href="{{ request()->fullUrlWithQuery(['filter' => 'all', 'sort' => request('sort')]) }}" 
                                       class="btn {{ isset($filter) && $filter === 'all' ? 'btn-modern-primary' : 'btn-outline-secondary' }}">
                                        Semua
                                    </a>
                                </div>
                            </div>

                            <!-- Sort Dropdown -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold mb-2">
                                    <i class="fas fa-sort me-2"></i>Susunan:
                                </label>
                                <select id="events-sort" class="form-select" onchange="if(this.value) window.location=this.value;">
                                    <option value="">Pilih Susunan...</option>
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'date_asc']) }}" {{ (isset($sort) && $sort === 'date_asc') ? 'selected' : '' }}>Tarikh: Terawal Dahulu</option>
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'date_desc']) }}" {{ (isset($sort) && $sort === 'date_desc') ? 'selected' : '' }}>Tarikh: Terkini Dahulu</option>
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'title_asc']) }}" {{ (isset($sort) && $sort === 'title_asc') ? 'selected' : '' }}>Tajuk: A → Z</option>
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'title_desc']) }}" {{ (isset($sort) && $sort === 'title_desc') ? 'selected' : '' }}>Tajuk: Z → A</option>
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ (isset($sort) && $sort === 'newest') ? 'selected' : '' }}>Terbaru Dicipta</option>
                                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}" {{ (isset($sort) && $sort === 'oldest') ? 'selected' : '' }}>Terlama Dicipta</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Event Cards --}}
                @foreach($events as $event)
                <div class="modern-card">
                    <div class="card-body">
                        
                        <!-- Event Icon -->
                        <div class="icon-circle">
                            <i class="fas fa-calendar-check"></i>
                        </div>

                        <!-- Event Title -->
                        <h2 class="fw-bold text-dark mb-2">{{ $event->title }}</h2>

                        <!-- Meta Information -->
                        <div class="mb-3">
                            <span class="modern-badge badge-primary me-2">
                                <i class="far fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                            </span>
                            <span class="modern-badge badge-info">
                                <i class="far fa-clock me-1"></i>{{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}
                            </span>
                        </div>

                        <!-- Event Description -->
                        <p class="card-text mb-3" style="line-height: 1.8;">
                            {{ Str::limit($event->description, 200, '...') }}
                        </p>

                        {{-- Link to Detail Page --}}
                        <a href="{{ route('events.show.public', $event->id) }}" class="btn btn-modern-primary">
                            Lihat Butiran <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
                @endforeach
                
                {{-- Empty State --}}
                @if($events->isEmpty())
                    <div class="modern-alert alert-info text-center">
                        <div class="icon-circle mx-auto mb-3">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h4>Tiada Acara Dijumpai</h4>
                        <p class="mb-0">Tiada acara yang sepadan dengan penapis anda. Cuba tukar penapis atau semak kembali tidak lama lagi.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection