@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Edit Destination</h1>
            <p class="text-muted small mb-0">Update details for: {{ $destination->title }}</p>
        </div>
        <a href="{{ route('admin.destinations') }}" class="btn btn-light border px-4 rounded-pill fw-bold shadow-sm">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Destination Name</label>
                        <input type="text" name="title" class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror" placeholder="e.g. Zanzibar" value="{{ old('title', $destination->title) }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Short Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="A brief overview of the destination...">{{ old('description', $destination->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Detailed Content (Storytelling)</label>
                        <textarea name="rich_content" id="editor-rich-content" class="form-control @error('rich_content') is-invalid @enderror">{{ old('rich_content', $destination->rich_content) }}</textarea>
                        @error('rich_content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-bold text-dark">Map Iframe (Google Maps Embed Code)</label>
                        <textarea name="map_iframe" class="form-control @error('map_iframe') is-invalid @enderror" rows="4" placeholder="Paste Google Maps iframe code here...">{{ old('map_iframe', $destination->map_iframe) }}</textarea>
                        <div class="form-text small mt-2">
                            <i class="fas fa-info-circle me-1"></i> How to get this: Go to <a href="https://www.google.com/maps" target="_blank">Google Maps</a> -> Search location -> Share -> Embed a map -> Copy HTML
                        </div>
                        @error('map_iframe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <h5 class="fw-bold mb-4" style="color: #3E2723;">Travel Details</h5>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Country/Location</label>
                        <input type="text" name="category" class="form-control rounded-3 @error('category') is-invalid @enderror" placeholder="e.g. Tanzania" value="{{ old('category', $destination->category) }}" required>
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Rate Range</label>
                        <input type="text" name="rate_range" class="form-control rounded-3 @error('rate_range') is-invalid @enderror" placeholder="e.g. $120 to $2820" value="{{ old('rate_range', $destination->rate_range) }}" required>
                        @error('rate_range') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Best Time to Visit</label>
                        <input type="text" name="best_time" class="form-control rounded-3 @error('best_time') is-invalid @enderror" placeholder="e.g. June to October" value="{{ old('best_time', $destination->best_time) }}" required>
                        @error('best_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">High Season</label>
                        <input type="text" name="high_season" class="form-control rounded-3 @error('high_season') is-invalid @enderror" placeholder="e.g. July to October" value="{{ old('high_season', $destination->high_season) }}" required>
                        @error('high_season') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Featured Image</label>
                        <div class="image-upload-wrapper border rounded-4 p-3 text-center position-relative" style="background-color: #fdfaf5; border-style: dashed !important;">
                            <input type="file" name="image" id="destImage" class="position-absolute opacity-0 w-100 h-100 top-0 start-0 cursor-pointer" accept="image/*">
                            @if($destination->image)
                            <div id="imagePreview" class="py-4 d-none">
                                <i class="fas fa-image fa-3x mb-3" style="color: #deb887;"></i>
                                <p class="mb-0 small text-muted">Click to change photo</p>
                            </div>
                            <img id="previewImg" src="{{ asset($destination->image) }}" class="img-fluid rounded-3 shadow-sm" alt="Preview">
                            @else
                            <div id="imagePreview" class="py-4">
                                <i class="fas fa-image fa-3x mb-3" style="color: #deb887;"></i>
                                <p class="mb-0 small text-muted">Upload a beautiful cover photo</p>
                            </div>
                            <img id="previewImg" src="#" class="img-fluid rounded-3 d-none shadow-sm" alt="Preview">
                            @endif
                        </div>
                        @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-earth w-100 py-3 rounded-pill fw-bold text-white shadow-sm" style="background-color: #8b4513;">
                        <i class="fas fa-save me-2"></i>Update Destination
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#editor-rich-content'), {
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
