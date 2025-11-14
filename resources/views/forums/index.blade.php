@extends('layouts.app')

@section('content')
<!-- ===========================
     FORUM INDEX PAGE
     List all forum posts
=========================== -->

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1><i class="fas fa-comments me-2"></i>Forum Perbincangan</h1>
        <p class="mb-0">Berbincang dan berkongsi pandangan dengan komuniti masjid</p>
    </div>
</div>

<!-- Main Content Section -->
<div class="content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @forelse($forums as $forum)
                    <div class="modern-card mb-4 hover-shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h3 class="h4 mb-3">
                                        <a href="{{ route('forums.show', $forum->slug) }}" class="text-decoration-none text-dark hover-primary">
                                            {{ $forum->title }}
                                        </a>
                                    </h3>
                                    
                                    <div class="text-muted mb-3">
                                        {{ Str::limit(strip_tags($forum->content), 200) }}
                                    </div>

                                    <div class="d-flex align-items-center gap-3 text-sm text-muted">
                                        <span>
                                            <i class="fas fa-user me-1"></i>
                                            {{ $forum->author->name }}
                                        </span>
                                        <span>
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $forum->created_at->diffForHumans() }}
                                        </span>
                                        <span>
                                            <i class="fas fa-comment me-1"></i>
                                            {{ $forum->comments->count() }} Komen
                                        </span>
                                    </div>
                                </div>

                                <div class="ms-3">
                                    <a href="{{ route('forums.show', $forum->slug) }}" class="btn btn-modern-primary btn-sm">
                                        Baca <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="modern-card text-center py-5">
                        <div class="card-body">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Tiada forum tersedia pada masa ini</h5>
                            <p class="text-muted">Sila semak semula kemudian</p>
                        </div>
                    </div>
                @endforelse

                <!-- Pagination -->
                @if($forums->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $forums->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

<style>
    .hover-shadow {
        transition: box-shadow 0.3s ease;
    }
    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
    .hover-primary:hover {
        color: #5c6bc0 !important;
    }
</style>
@endsection
