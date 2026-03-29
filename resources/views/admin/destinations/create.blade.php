@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Create Destination</h1>
            <p class="text-muted small mb-0">Add a new location to your travel map</p>
        </div>
        <a href="{{ route('admin.destinations') }}" class="btn btn-light border px-4 rounded-pill fw-bold shadow-sm">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Destination Name</label>
                        <input type="text" name="name" class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror" placeholder="e.g. Serengeti National Park" value="{{ old('name') }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Description</label>
                        <textarea name="description" id="editor-description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <h5 class="fw-bold mb-4" style="color: #3E2723;">Location Details</h5>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Location</label>
                        <input type="text" name="location" class="form-control rounded-3 @error('location') is-invalid @enderror" placeholder="e.g. Northern Tanzania" value="{{ old('location') }}" required>
                        @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Type</label>
                        <select name="type" class="form-select rounded-3 @error('type') is-invalid @enderror" required>
                            <option value="">Select Type</option>
                            <option value="National Park" {{ old('type') == 'National Park' ? 'selected' : '' }}>National Park</option>
                            <option value="Island" {{ old('type') == 'Island' ? 'selected' : '' }}>Island</option>
                            <option value="Mountain" {{ old('type') == 'Mountain' ? 'selected' : '' }}>Mountain</option>
                            <option value="Beach" {{ old('type') == 'Beach' ? 'selected' : '' }}>Beach</option>
                            <option value="City" {{ old('type') == 'City' ? 'selected' : '' }}>City</option>
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Featured Image</label>
                        <div class="image-upload-wrapper border rounded-4 p-3 text-center position-relative" style="background-color: #fdfaf5; border-style: dashed !important;">
                            <input type="file" name="image" id="destImage" class="position-absolute opacity-0 w-100 h-100 top-0 start-0 cursor-pointer" accept="image/*">
                            <div id="imagePreview" class="py-4">
                                <i class="fas fa-image fa-3x mb-3" style="color: #deb887;"></i>
                                <p class="mb-0 small text-muted">Upload a beautiful cover photo</p>
                            </div>
                            <img id="previewImg" src="#" class="img-fluid rounded-3 d-none shadow-sm" alt="Preview">
                        </div>
                        @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-earth w-100 py-3 rounded-pill fw-bold text-white shadow-sm" style="background-color: #8b4513;">
                        <i class="fas fa-save me-2"></i>Save Destination
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor-description'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
    }).catch(error => console.error(error));

    document.getElementById('destImage').addEventListener('change', function(e) {
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
@endpush
@endsection
