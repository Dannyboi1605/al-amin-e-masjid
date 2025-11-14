@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Pengurusan Acara</h1>
        
        {{-- BUTANG CREATE NEW (Icon Plus) --}}
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Cipta Acara Baru
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
                        <th>Deskripsi</th>
                        <th>Tarikh Acara</th>
                        <th>Lokasi</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->title }}</td>
                        <td style="max-width:320px">{{ Str::limit($event->description, 80, '...') }}</td>
                        <td>{{ $event->date->format('d M Y') }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->created_at->format('d M Y H:i') }}</td>
                        <td>{{ $event->updated_at->format('d M Y H:i') }}</td>
                        
                        {{-- BUTTONS: VIEW, EDIT & DELETE --}}
                        <td class="text-center" style="width: 200px;">
                            {{-- Button View (Icon Eye) --}}
                            <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-sm btn-info me-2" title="View">
                                <i class="fas fa-eye"></i>
                            </a>

                            {{-- Button Edit (Icon Pencil) --}}
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-warning me-2" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            
                            {{-- Form Delete (Icon Trash) --}}
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Padam acara ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
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