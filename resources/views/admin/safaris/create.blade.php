@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Create Safari Package</h1>
            <p class="text-muted small mb-0">Add a new wildlife safari tour to your inventory</p>
        </div>
        <a href="{{ route('admin.safaris') }}" class="btn btn-light border px-4 rounded-pill fw-bold shadow-sm">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <form action="{{ route('admin.safaris.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Package Title</label>
                        <input type="text" name="title" class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror" placeholder="e.g. 5 Days Serengeti & Ngorongoro" value="{{ old('title') }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Description</label>
                        <textarea name="description" id="editor-description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Detailed Itinerary</label>
                        <textarea name="itinerary" id="editor-itinerary" class="form-control @error('itinerary') is-invalid @enderror">{{ old('itinerary') }}</textarea>
                        @error('itinerary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h5 class="fw-bold mb-4" style="color: #3E2723;">Inclusions & Exclusions</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-dark">What's Included</label>
                            <textarea name="inclusions" id="editor-inclusions" class="form-control">{{ old('inclusions') }}</textarea>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-dark">What's Excluded</label>
                            <textarea name="exclusions" id="editor-exclusions" class="form-control">{{ old('exclusions') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <h5 class="fw-bold mb-4" style="color: #3E2723;">Pricing & Media</h5>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Base Price (USD)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" name="price" class="form-control form-control-lg rounded-end-3 @error('price') is-invalid @enderror" placeholder="0.00" value="{{ old('price') }}" required>
                        </div>
                        @error('price') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Featured Image</label>
                        <div class="image-upload-wrapper border rounded-4 p-3 text-center position-relative" style="background-color: #fdfaf5; border-style: dashed !important;">
                            <input type="file" name="image" id="packageImage" class="position-absolute opacity-0 w-100 h-100 top-0 start-0 cursor-pointer" accept="image/*">
                            <div id="imagePreview" class="py-4">
                                <i class="fas fa-cloud-upload-alt fa-3x mb-3" style="color: #deb887;"></i>
                                <p class="mb-0 small text-muted">Click to upload or drag and drop</p>
                                <p class="smaller text-muted mt-1">(Max 2MB: JPG, PNG, WEBP)</p>
                            </div>
                            <img id="previewImg" src="#" class="img-fluid rounded-3 d-none shadow-sm" alt="Preview">
                        </div>
                        @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-earth w-100 py-3 rounded-pill fw-bold text-white shadow-sm" style="background-color: #8b4513;">
                        <i class="fas fa-save me-2"></i>Save Package
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    const editorConfig = {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
    };

    ['#editor-description', '#editor-itinerary', '#editor-inclusions', '#editor-exclusions'].forEach(selector => {
        ClassicEditor.create(document.querySelector(selector), editorConfig).catch(error => console.error(error));
    });

    document.getElementById('packageImage').addEventListener('change', function(e) {
        const preview = document.getElementById('previewImg');
        const icon = document.getElementById('imagePreview');
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                icon.classList.add('d-none');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
<style>
    .ck-editor__editable { min-height: 200px; }
    .cursor-pointer { cursor: pointer; }
</style>
@endpush
@endsection
