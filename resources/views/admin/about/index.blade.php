@extends('layouts.admin')

@section('content')
<!-- ===========================
     ADMIN ABOUT US INDEX
     List all about info entries
=========================== -->

<div class="container-fluid py-4">
    
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><i class="fas fa-info-circle me-2"></i>About Us Management</h2>
            <p class="text-muted mb-0">Manage vision, mission, objectives, and masjid images</p>
        </div>
        <a href="{{ route('admin.about.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New About Info
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- About Info List -->
    <div class="card shadow-sm">
        <div class="card-body">
            
            @if($abouts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Vision Preview</th>
                                <th>Mission Preview</th>
                                <th>Images</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($abouts as $about)
                            <tr>
                                <td><strong>#{{ $about->id }}</strong></td>
                                <td>
                                    <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ Str::limit($about->vision, 50) }}
                                    </div>
                                </td>
                                <td>
                                    <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ Str::limit($about->mission, 50) }}
                                    </div>
                                </td>
                                <td>
                                    @if($about->images && count($about->images) > 0)
                                        <span class="badge bg-primary">
                                            <i class="fas fa-images me-1"></i>{{ count($about->images) }} images
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">No images</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $about->created_at->format('d M Y') }}
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.about.edit', $about) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.about.destroy', $about) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this entry? All associated images will be deleted.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $abouts->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-info-circle fa-4x text-muted opacity-50"></i>
                    </div>
                    <h5 class="text-muted">No About Info Entries Yet</h5>
                    <p class="text-muted mb-4">Create your first about info entry to display on the public page.</p>
                    <a href="{{ route('admin.about.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add First Entry
                    </a>
                </div>
            @endif

        </div>
    </div>

    <!-- Information Notice -->
    <div class="alert alert-info mt-4" role="alert">
        <i class="fas fa-lightbulb me-2"></i>
        <strong>Tip:</strong> The public "Tentang Kami" page will display the most recent entry. You can manage multiple entries here for version control.
    </div>

</div>

@endsection
