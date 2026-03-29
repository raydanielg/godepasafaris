@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Create Kilimanjaro Package</h1>
            <p class="text-muted small mb-0">Add a new mountain trekking route</p>
        </div>
        <a href="{{ route('admin.kilimanjaro') }}" class="btn btn-light border px-4 rounded-pill fw-bold shadow-sm">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <form action="{{ route('admin.kilimanjaro.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Package Title</label>
                        <input type="text" name="title" class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror" placeholder="e.g. 7 Days Machame Route" value="{{ old('title') }}" required>
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
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <h5 class="fw-bold mb-4" style="color: #3E2723;">Trek Details</h5>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Route Name</label>
                        <input type="text" name="route_name" class="form-control rounded-3 @error('route_name') is-invalid @enderror" placeholder="e.g. Machame, Lemosho" value="{{ old('route_name') }}" required>
                        @error('route_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-6 mb-4">
                            <label class="form-label fw-bold text-dark">Duration (Days)</label>
                            <input type="number" name="days" class="form-control rounded-3 @error('days') is-invalid @enderror" placeholder="7" value="{{ old('days') }}" required>
                            @error('days') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-6 mb-4">
                            <label class="form-label fw-bold text-dark">Price (USD)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">$</span>
                                <input type="number" name="price" class="form-control rounded-end-3 @error('price') is-invalid @enderror" placeholder="0" value="{{ old('price') }}" required>
                            </div>
                            @error('price') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Featured Image</label>
                        <div class="image-upload-wrapper border rounded-4 p-3 text-center position-relative" style="background-color: #fdfaf5; border-style: dashed !important;">
                            <input type="file" name="image" id="packageImage" class="position-absolute opacity-0 w-100 h-100 top-0 start-0 cursor-pointer" accept="image/*">
                            <div id="imagePreview" class="py-4">
                                <i class="fas fa-mountain fa-3x mb-3" style="color: #deb887;"></i>
                                <p class="mb-0 small text-muted">Upload route map or trek photo</p>
                            </div>
                            <img id="previewImg" src="#" class="img-fluid rounded-3 d-none shadow-sm" alt="Preview">
                        </div>
                        @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-earth w-100 py-3 rounded-pill fw-bold text-white shadow-sm" style="background-color: #8b4513;">
                        <i class="fas fa-save me-2"></i>Save Trek
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

    ['#editor-description', '#editor-itinerary'].forEach(selector => {
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
@endpush
@endsection
