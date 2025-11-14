@extends('layouts.admin')

@section('content')
<!-- ===========================
     ADMIN ABOUT US EDIT
     Form to update about info
=========================== -->

<div class="container-fluid py-4">
    
    <!-- Page Header -->
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.about.index') }}">About Us</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit #{{ $about->id }}</li>
            </ol>
        </nav>
        <h2 class="mb-1"><i class="fas fa-edit me-2"></i>Edit About Info</h2>
        <p class="text-muted mb-0">Update vision, mission, objectives, and images</p>
    </div>

    <!-- Edit Form -->
    <div class="row">
        <div class="col-lg-10 col-xl-9">
            <div class="card shadow-sm">
                <div class="card-body">
                    
                    <form action="{{ route('admin.about.update', $about) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Vision Field -->
                        <div class="mb-4">
                            <label for="vision" class="form-label fw-bold">
                                <i class="fas fa-eye me-2 text-primary"></i>Vision Statement <span class="text-danger">*</span>
                            </label>
                            <textarea name="vision" 
                                      id="vision" 
                                      class="form-control @error('vision') is-invalid @enderror" 
                                      rows="4" 
                                      required>{{ old('vision', $about->vision) }}</textarea>
                            @error('vision')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mission Field -->
                        <div class="mb-4">
                            <label for="mission" class="form-label fw-bold">
                                <i class="fas fa-bullseye me-2 text-success"></i>Mission Statement <span class="text-danger">*</span>
                            </label>
                            <textarea name="mission" 
                                      id="mission" 
                                      class="form-control @error('mission') is-invalid @enderror" 
                                      rows="4" 
                                      required>{{ old('mission', $about->mission) }}</textarea>
                            @error('mission')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Objectives Field -->
                        <div class="mb-4">
                            <label for="objectives" class="form-label fw-bold">
                                <i class="fas fa-list-check me-2 text-danger"></i>Objectives <span class="text-danger">*</span>
                            </label>
                            <textarea name="objectives" 
                                      id="objectives" 
                                      class="form-control @error('objectives') is-invalid @enderror" 
                                      rows="6" 
                                      required>{{ old('objectives', $about->objectives) }}</textarea>
                            @error('objectives')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Divider -->
                        <hr class="my-4">

                        <!-- Existing Images -->
                        @if($about->images && count($about->images) > 0)
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-images me-2 text-warning"></i>Existing Images
                            </label>
                            <p class="text-muted small mb-3">
                                <i class="fas fa-info-circle me-1"></i>
                                Check images you want to delete, then save the form
                            </p>
                            <div class="row g-3">
                                @foreach($about->images as $index => $image)
                                <div class="col-md-3 col-sm-4 col-6">
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $image) }}" 
                                             class="img-fluid rounded shadow-sm" 
                                             style="width: 100%; height: 150px; object-fit: cover;"
                                             alt="Image {{ $index + 1 }}">
                                        
                                        <!-- Delete Checkbox Overlay -->
                                        <div class="position-absolute top-0 start-0 m-2">
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="checkbox" 
                                                       name="delete_images[]" 
                                                       value="{{ $image }}" 
                                                       id="delete_{{ $index }}"
                                                       style="width: 20px; height: 20px; cursor: pointer;">
                                                <label class="form-check-label visually-hidden" for="delete_{{ $index }}">
                                                    Delete
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <!-- Image Number Badge -->
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge bg-dark">{{ $index + 1 }}</span>
                                        </div>
                                    </div>
                                    <small class="text-muted d-block mt-1 text-center">
                                        <i class="far fa-trash-alt me-1"></i>Check to delete
                                    </small>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Add New Images -->
                        <div class="mb-4">
                            <label for="images" class="form-label fw-bold">
                                <i class="fas fa-plus-circle me-2 text-info"></i>Add New Images
                            </label>
                            <input type="file" 
                                   name="images[]" 
                                   id="images" 
                                   class="form-control @error('images.*') is-invalid @enderror" 
                                   multiple 
                                   accept="image/*"
                                   onchange="previewNewImages(event)">
                            @error('images.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-1">
                                <i class="fas fa-info-circle me-1"></i>
                                Upload additional images. Max 2MB per image.
                            </small>

                            <!-- New Image Preview Container -->
                            <div id="newImagePreviewContainer" class="row g-2 mt-3" style="display: none;">
                                <!-- Previews will be inserted here by JavaScript -->
                            </div>
                        </div>

                        <!-- Warning Alert -->
                        <div class="alert alert-warning" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Warning:</strong> Deleted images cannot be recovered. Make sure you want to remove them before saving.
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Update About Info
                            </button>
                            <a href="{{ route('admin.about.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- ==================
     JAVASCRIPT
     Image preview functionality
     ================== -->
<script>
    function previewNewImages(event) {
        const container = document.getElementById('newImagePreviewContainer');
        const files = event.target.files;
        
        // Clear existing previews
        container.innerHTML = '';
        
        if (files.length > 0) {
            container.style.display = 'flex';
            
            Array.from(files).forEach((file, index) => {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 col-sm-4 col-6';
                    
                    col.innerHTML = `
                        <div class="position-relative">
                            <img src="${e.target.result}" 
                                 class="img-fluid rounded shadow-sm" 
                                 style="width: 100%; height: 150px; object-fit: cover;"
                                 alt="New Preview ${index + 1}">
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-success">New ${index + 1}</span>
                            </div>
                        </div>
                    `;
                    
                    container.appendChild(col);
                };
                
                reader.readAsDataURL(file);
            });
        } else {
            container.style.display = 'none';
        }
    }

    // Highlight selected images for deletion
    document.querySelectorAll('input[name="delete_images[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const imgContainer = this.closest('.position-relative');
            if (this.checked) {
                imgContainer.style.opacity = '0.5';
                imgContainer.style.border = '3px solid red';
            } else {
                imgContainer.style.opacity = '1';
                imgContainer.style.border = 'none';
            }
        });
    });
</script>

@endsection
