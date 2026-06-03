@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Edit Safari Package</h1>
            <p class="text-muted small mb-0">Update details for: {{ $package->title }}</p>
        </div>
        <a href="{{ route('admin.safaris') }}" class="btn btn-light border px-4 rounded-pill fw-bold shadow-sm">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <form action="{{ route('admin.safaris.update', $package) }}" method="POST" enctype="multipart/form-data" id="editSafariForm">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Package Title</label>
                        <input type="text" name="title" class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror" placeholder="e.g. 5 Days Serengeti & Ngorongoro" value="{{ old('title', $package->title) }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Description</label>
                        <textarea name="description" id="editor-description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $package->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Detailed Itinerary (JSON Format)</label>
                        <textarea name="itinerary" id="editor-itinerary" class="form-control @error('itinerary') is-invalid @enderror" rows="10" placeholder='[{"day": 1, "title": "Day 1", "description": "Description", "image": "path/to/image.jpg"}]'>{{ old('itinerary', is_array($package->itinerary) ? json_encode($package->itinerary, JSON_PRETTY_PRINT) : $package->itinerary) }}</textarea>
                        <small class="text-muted">Enter itinerary as JSON array with day, title, description, and optional image fields</small>
                        @error('itinerary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h5 class="fw-bold mb-4" style="color: #3E2723;">Inclusions & Exclusions (JSON Format)</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-dark">What's Included</label>
                            <textarea name="inclusions" id="editor-inclusions" class="form-control" rows="6" placeholder='["Item 1", "Item 2", "Item 3"]'>{{ old('inclusions', is_array($package->inclusions) ? json_encode($package->inclusions, JSON_PRETTY_PRINT) : $package->inclusions) }}</textarea>
                            <small class="text-muted">Enter as JSON array of strings</small>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-dark">What's Excluded</label>
                            <textarea name="exclusions" id="editor-exclusions" class="form-control" rows="6" placeholder='["Item 1", "Item 2", "Item 3"]'>{{ old('exclusions', is_array($package->exclusions) ? json_encode($package->exclusions, JSON_PRETTY_PRINT) : $package->exclusions) }}</textarea>
                            <small class="text-muted">Enter as JSON array of strings</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <h5 class="fw-bold mb-4" style="color: #3E2723;">
                        <i class="fas fa-dollar-sign me-2"></i>Pricing
                    </h5>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Base Price (USD)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">$</span>
                            <input type="number" name="price" class="form-control form-control-lg rounded-end-3 @error('price') is-invalid @enderror" placeholder="0.00" value="{{ old('price', $package->price) }}" required>
                        </div>
                        @error('price') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Currency</label>
                        <select name="currency" class="form-select rounded-3">
                            <option value="USD" {{ old('currency', $package->currency ?? 'USD') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                            <option value="EUR" {{ old('currency', $package->currency ?? 'USD') == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                            <option value="GBP" {{ old('currency', $package->currency ?? 'USD') == 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                            <option value="TZS" {{ old('currency', $package->currency ?? 'USD') == 'TZS' ? 'selected' : '' }}>TZS (TSh)</option>
                            <option value="KES" {{ old('currency', $package->currency ?? 'USD') == 'KES' ? 'selected' : '' }}>KES (KSh)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Duration (Days)</label>
                        <input type="number" name="days" class="form-control form-control-lg rounded-3 @error('days') is-invalid @enderror" placeholder="e.g. 5" value="{{ old('days', $package->days) }}" required>
                        @error('days') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Group Discount (%)</label>
                        <input type="number" name="group_discount" class="form-control rounded-3 @error('group_discount') is-invalid @enderror" placeholder="e.g. 10" value="{{ old('group_discount', $package->group_discount ?? '') }}">
                        <small class="text-muted">Discount for groups of 4+ people</small>
                        @error('group_discount') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Minimum Group Size</label>
                        <input type="number" name="min_group_size" class="form-control rounded-3 @error('min_group_size') is-invalid @enderror" placeholder="e.g. 2" value="{{ old('min_group_size', $package->min_group_size ?? '') }}">
                        @error('min_group_size') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <h5 class="fw-bold mb-4" style="color: #3E2723;">
                        <i class="fas fa-image me-2"></i>Featured Image
                    </h5>
                    <div class="image-upload-wrapper border rounded-4 p-3 text-center position-relative" style="background-color: #fdfaf5; border-style: dashed !important;">
                        <input type="file" name="image" id="packageImage" class="position-absolute opacity-0 w-100 h-100 top-0 start-0 cursor-pointer" accept="image/*">
                        @if($package->image)
                        <div id="imagePreview" class="py-4 d-none">
                            <i class="fas fa-cloud-upload-alt fa-3x mb-3" style="color: #deb887;"></i>
                            <p class="mb-0 small text-muted">Click to change or drag and drop</p>
                        </div>
                        <img id="previewImg" src="{{ asset($package->image) }}" class="img-fluid rounded-3 shadow-sm" alt="Preview">
                        @else
                        <div id="imagePreview" class="py-4">
                            <i class="fas fa-cloud-upload-alt fa-3x mb-3" style="color: #deb887;"></i>
                            <p class="mb-0 small text-muted">Click to upload or drag and drop</p>
                        </div>
                        <img id="previewImg" src="#" class="img-fluid rounded-3 d-none shadow-sm" alt="Preview">
                        @endif
                    </div>
                    @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h5 class="fw-bold mb-4" style="color: #3E2723;">
                        <i class="fas fa-cog me-2"></i>Settings
                    </h5>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Category</label>
                        <select name="category" class="form-select rounded-3">
                            <option value="">Select category</option>
                            <option value="Safari" {{ old('category', $package->category ?? '') == 'Safari' ? 'selected' : '' }}>Safari</option>
                            <option value="Mountain" {{ old('category', $package->category ?? '') == 'Mountain' ? 'selected' : '' }}>Mountain</option>
                            <option value="Beach" {{ old('category', $package->category ?? '') == 'Beach' ? 'selected' : '' }}>Beach</option>
                            <option value="Cultural" {{ old('category', $package->category ?? '') == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                        </select>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured" {{ $package->is_featured ?? false ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="isFeatured">Featured Package</label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" {{ $package->is_active ?? true ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="isActive">Active</label>
                    </div>

                    <button type="submit" class="btn btn-earth w-100 py-3 rounded-pill fw-bold text-white shadow-sm" style="background-color: #8b4513;">
                        <i class="fas fa-save me-2"></i>Update Package
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
