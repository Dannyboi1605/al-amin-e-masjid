@extends('layouts.app')

@section('content')
<!-- ===========================
     FORUM SHOW PAGE
     Single forum post with comments
=========================== -->

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-3">
                <li class="breadcrumb-item"><a href="{{ route('forums.index') }}">Forum</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $forum->title }}</li>
            </ol>
        </nav>
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

                <!-- Forum Post -->
                <div class="modern-card mb-4">
                    <div class="card-body">
                        <h1 class="h2 mb-3">{{ $forum->title }}</h1>
                        
                        <div class="d-flex align-items-center gap-3 text-sm text-muted mb-4 pb-3 border-bottom">
                            <span>
                                <i class="fas fa-user me-1"></i>
                                Oleh <strong>{{ $forum->author->name }}</strong>
                            </span>
                            <span>
                                <i class="fas fa-clock me-1"></i>
                                {{ $forum->created_at->format('d M Y, h:i A') }}
                            </span>
                        </div>

                        <div class="forum-content">
                            {!! nl2br(e($forum->content)) !!}
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="modern-card mb-4">
                    <div class="card-body">
                        <h3 class="h4 mb-4">
                            <i class="fas fa-comments me-2"></i>
                            Komen ({{ $forum->topLevelComments->count() }})
                        </h3>

                        @auth
                            <!-- Comment Form -->
                            <div class="comment-form-container mb-4 p-3 bg-light rounded">
                                <form action="{{ route('forums.comments.store', $forum->slug) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="content" class="form-label fw-bold">Tulis komen anda</label>
                                        <textarea 
                                            name="content" 
                                            id="content" 
                                            class="form-control @error('content') is-invalid @enderror" 
                                            rows="4" 
                                            placeholder="Kongsi pandangan anda..."
                                            required
                                        >{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-modern-primary">
                                        <i class="fas fa-paper-plane me-2"></i>Hantar Komen
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Sila <a href="{{ route('login') }}">log masuk</a> untuk meninggalkan komen.
                            </div>
                        @endauth

                        <!-- Comments List -->
                        <div class="comments-list mt-4">
                            @forelse($forum->topLevelComments as $comment)
                                @include('forums.partials.comment', ['comment' => $comment, 'forum' => $forum])
                            @empty
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-comment-slash fa-2x mb-2"></i>
                                    <p>Tiada komen lagi. Jadilah yang pertama berkongsi pandangan!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .forum-content {
        line-height: 1.8;
        font-size: 1.05rem;
    }
    .comment-form-container {
        border-left: 4px solid #5c6bc0;
    }
</style>

<!-- Reply Form Toggle Script -->
<script>
    function toggleReplyForm(commentId) {
        const form = document.getElementById('reply-form-' + commentId);
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>
@endsection
