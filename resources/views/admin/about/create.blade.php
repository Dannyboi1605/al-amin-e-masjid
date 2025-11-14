@extends('layouts.admin')

@section('content')
<!-- ===========================
     ADMIN ABOUT US CREATE
     Form to add new about info
=========================== -->

<div class="container-fluid py-4">
    
    <!-- Page Header -->
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.about.index') }}">About Us</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create New</li>
            </ol>
        </nav>
        <h2 class="mb-1"><i class="fas fa-plus-circle me-2"></i>Create New About Info</h2>
        <p class="text-muted mb-0">Add vision, mission, objectives, and images for the About Us page</p>
    </div>

    <!-- Create Form -->
    <div class="row">
        <div class="col-lg-10 col-xl-9">
            <div class="card shadow-sm">
                <div class="card-body">
                    
                    <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Vision Field -->
                        <div class="mb-4">
                            <label for="vision" class="form-label fw-bold">
                                <i class="fas fa-eye me-2 text-primary"></i>Vision Statement <span class="text-danger">*</span>
                            </label>
                            <textarea name="vision" 
                                      id="vision" 
                                      class="form-control @error('vision') is-invalid @enderror" 
                                      rows="4" 
                                      placeholder="Enter the vision statement for Masjid Al-Amin..."
                                      required>{{ old('vision') }}</textarea>
                            @error('vision')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>Describe the long-term aspirations and goals
                            </small>
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
                                      placeholder="Enter the mission statement for Masjid Al-Amin..."
                                      required>{{ old('mission') }}</textarea>
                            @error('mission')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>Explain the purpose and approach to achieving the vision
                            </small>
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
                                      placeholder="Enter the objectives (one per line or use bullet points)..."
                                      required>{{ old('objectives') }}</textarea>
                            @error('objectives')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>List specific, measurable objectives. You can use multiple lines.
                            </small>
                        </div>

                        <!-- Divider -->
                        <hr class="my-4">

                        <!-- Images Upload -->
                        <div class="mb-4">
                            <label for="images" class="form-label fw-bold">
                                <i class="fas fa-images me-2 text-info"></i>Masjid Images
                            </label>
                            <input type="file" 
                                   name="images[]" 
                                   id="images" 
                                   class="form-control @error('images.*') is-invalid @enderror" 
                                   multiple 
                                   accept="image/*"
                                   onchange="previewImages(event)">
                            @error('images.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted d-block mt-1">
                                <i class="fas fa-info-circle me-1"></i>
                                Upload multiple images (JPEG, PNG, JPG, GIF). Max 2MB per image. Hold Ctrl/Cmd to select multiple files.
                            </small>

                            <!-- Image Preview Container -->
                            <div id="imagePreviewContainer" class="row g-2 mt-3" style="display: none;">
                                <!-- Previews will be inserted here by JavaScript -->
                            </div>
                        </div>

                        <!-- Information Alert -->
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-lightbulb me-2"></i>
                            <strong>Note:</strong> This information will be displayed on the public "Tentang Kami" page. Make sure all content is accurate and appropriate.
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Create About Info
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
    function previewImages(event) {
        const container = document.getElementById('imagePreviewContainer');
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
                                 alt="Preview ${index + 1}">
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-dark">${index + 1}</span>
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
</script>

@endsection
