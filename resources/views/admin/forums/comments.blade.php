@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Moderasi Komen Forum</h1>
        <a href="{{ route('admin.forums.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali ke Forum
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter and Sort Controls -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-filter me-2"></i>Tapis:
                    </label>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.forums.comments', ['filter' => 'all', 'sort' => $sort]) }}" 
                           class="btn btn-sm {{ $filter === 'all' ? 'btn-primary' : 'btn-outline-primary' }}">
                            Semua
                        </a>
                        <a href="{{ route('admin.forums.comments', ['filter' => 'visible', 'sort' => $sort]) }}" 
                           class="btn btn-sm {{ $filter === 'visible' ? 'btn-success' : 'btn-outline-success' }}">
                            Kelihatan
                        </a>
                        <a href="{{ route('admin.forums.comments', ['filter' => 'hidden', 'sort' => $sort]) }}" 
                           class="btn btn-sm {{ $filter === 'hidden' ? 'btn-warning' : 'btn-outline-warning' }}">
                            Tersembunyi
                        </a>
                        <a href="{{ route('admin.forums.comments', ['filter' => 'deleted', 'sort' => $sort]) }}" 
                           class="btn btn-sm {{ $filter === 'deleted' ? 'btn-danger' : 'btn-outline-danger' }}">
                            Dipadam
                        </a>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-sort me-2"></i>Susunan:
                    </label>
                    <select class="form-select" onchange="if(this.value) window.location=this.value;">
                        <option value="{{ route('admin.forums.comments', ['filter' => $filter, 'sort' => 'newest']) }}" 
                                {{ $sort === 'newest' ? 'selected' : '' }}>
                            Terbaru Dahulu
                        </option>
                        <option value="{{ route('admin.forums.comments', ['filter' => $filter, 'sort' => 'oldest']) }}" 
                                {{ $sort === 'oldest' ? 'selected' : '' }}>
                            Terlama Dahulu
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            @if($comments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pengguna</th>
                                <th>Forum</th>
                                <th>Komen</th>
                                <th>Status</th>
                                <th>Tarikh</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                            <tr class="{{ $comment->is_hidden ? 'table-warning' : '' }} {{ $comment->trashed() ? 'table-danger' : '' }}">
                                <td>{{ $comment->id }}</td>
                                <td>
                                    <strong>{{ $comment->user->name }}</strong>
                                    @if($comment->user->role === 'admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('forums.show', $comment->forum->slug) }}" target="_blank" class="text-decoration-none">
                                        {{ Str::limit($comment->forum->title, 30) }}
                                    </a>
                                </td>
                                <td>{{ Str::limit($comment->content, 60) }}</td>
                                <td>
                                    @if($comment->trashed())
                                        <span class="badge bg-danger">Dipadam</span>
                                    @elseif($comment->is_hidden)
                                        <span class="badge bg-warning">Tersembunyi</span>
                                    @else
                                        <span class="badge bg-success">Kelihatan</span>
                                    @endif

                                    @if($comment->parent_id)
                                        <span class="badge bg-info">Balasan</span>
                                    @endif
                                </td>
                                <td>{{ $comment->created_at->format('d M Y') }}</td>
                                <td class="text-center" style="width: 200px;">
                                    @if(!$comment->trashed())
                                        <!-- Toggle Hidden/Visible -->
                                        <form action="{{ route('admin.comments.toggle-hidden', $comment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm {{ $comment->is_hidden ? 'btn-success' : 'btn-warning' }}" title="{{ $comment->is_hidden ? 'Tunjukkan' : 'Sembunyikan' }}">
                                                <i class="fas {{ $comment->is_hidden ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                            </button>
                                        </form>

                                        <!-- Soft Delete -->
                                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Padam komen ini?');" title="Padam">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @else
                                        <!-- Restore -->
                                        <form action="{{ route('admin.comments.restore', $comment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Pulihkan">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </form>

                                        <!-- Force Delete -->
                                        <form action="{{ route('admin.comments.force-delete', $comment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-dark" onclick="return confirm('Padam kekal komen ini? Tindakan ini tidak boleh dibatalkan!');" title="Padam Kekal">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($comments->hasPages())
                    <div class="d-flex justify-content-center mt-3">
                        {{ $comments->appends(['filter' => $filter, 'sort' => $sort])->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-comment-slash fa-3x mb-3"></i>
                    <p>Tiada komen dijumpai untuk tapisan ini</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Stats Summary -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="mb-0">{{ \App\Models\Comment::count() }}</h3>
                    <small class="text-muted">Jumlah Komen</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <h3 class="mb-0">{{ \App\Models\Comment::where('is_hidden', false)->count() }}</h3>
                    <small>Kelihatan</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-warning">
                <div class="card-body">
                    <h3 class="mb-0">{{ \App\Models\Comment::where('is_hidden', true)->count() }}</h3>
                    <small>Tersembunyi</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-danger text-white">
                <div class="card-body">
                    <h3 class="mb-0">{{ \App\Models\Comment::onlyTrashed()->count() }}</h3>
                    <small>Dipadam</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
