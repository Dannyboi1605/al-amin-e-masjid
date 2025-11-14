@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Pengurusan Forum</h1>
        
        {{-- BUTANG CREATE NEW (Icon Plus) --}}
        <a href="{{ route('admin.forums.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Cipta Forum Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tajuk</th>
                        <th>Pengarang</th>
                        <th>Komen</th>
                        <th>Diterbitkan</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($forums as $forum)
                    <tr>
                        <td>{{ $forum->id }}</td>
                        <td>
                            <a href="{{ route('forums.show', $forum->slug) }}" target="_blank" class="text-decoration-none">
                                {{ $forum->title }}
                            </a>
                        </td>
                        <td>{{ $forum->author->name }}</td>
                        <td>
                            <span class="badge bg-info">{{ $forum->comments_count }}</span>
                        </td>
                        <td>{{ $forum->created_at->format('d M Y') }}</td>
                        
                        {{-- BUTTONS EDIT & DELETE --}}
                        <td class="text-center" style="width: 150px;">
                            
                            {{-- Button Edit (Icon Pensel) --}}
                            <a href="{{ route('admin.forums.edit', $forum->slug) }}" class="btn btn-sm btn-warning me-2">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            
                            {{-- Form Delete (Icon Tong Sampah) --}}
                            <form action="{{ route('admin.forums.destroy', $forum->slug) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Padam forum ini? Semua komen akan turut dipadam.');">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            @if($forums->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $forums->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Link to Comments Moderation -->
    <div class="mt-4">
        <a href="{{ route('admin.forums.comments') }}" class="btn btn-outline-primary">
            <i class="fas fa-comments"></i> Moderasi Komen
        </a>
    </div>
</div>
@endsection
