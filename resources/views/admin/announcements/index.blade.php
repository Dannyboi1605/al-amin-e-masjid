@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Pengurusan Pengumuman</h1>
        
        {{-- BUTANG CREATE NEW (Icon Plus) --}}
        <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Cipta Pengumuman Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Preview Kandungan</th>
                        <th>Diterbitkan</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($announcements as $announcement)
                    <tr>
                        <td>{{ $announcement->id }}</td>
                        <td>{{ $announcement->title }}</td>
                        <td>{{ Str::limit($announcement->content, 60, '...') }}</td>
                        <td>{{ $announcement->created_at->format('d M Y') }}</td>
                        
                        {{-- BUTTONS EDIT & DELETE --}}
                        <td class="text-center" style="width: 150px;">
                            
                            {{-- Button Edit (Icon Pensel) --}}
                            <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="btn btn-sm btn-warning me-2">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            
                            {{-- Form Delete (Icon Tong Sampah) --}}
                            <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Padam pengumuman ini?');">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection