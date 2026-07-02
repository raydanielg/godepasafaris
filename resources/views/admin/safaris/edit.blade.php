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
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label fw-bold text-dark mb-0">Detailed Itinerary</label>
                            <div class="btn-group btn-group-sm" role="group">
                                <input type="radio" class="btn-check" name="itinerary_mode" id="itinerary_json" value="json" checked>
                                <label class="btn btn-outline-secondary" for="itinerary_json">JSON</label>
                                <input type="radio" class="btn-check" name="itinerary_mode" id="itinerary_text" value="text">
                                <label class="btn btn-outline-secondary" for="itinerary_text">Text Editor</label>
                            </div>
                        </div>
                        <textarea name="itinerary" id="editor-itinerary" class="form-control @error('itinerary') is-invalid @enderror" rows="15" placeholder='[{"day": 1, "title": "Day 1", "description": "Description", "image": "path/to/image.jpg"}]' style="font-family: 'Courier New', monospace; font-size: 13px; line-height: 1.5; background-color: #f8f9fa;">{{ old('itinerary', is_array($package->itinerary) ? json_encode($package->itinerary, JSON_PRETTY_PRINT) : $package->itinerary) }}</textarea>
                        <div id="itinerary-ckeditor" class="d-none"></div>
                        <small class="text-muted">JSON mode: Enter as JSON array. Text mode: Use rich text editor.</small>
                        @error('itinerary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-4 p-4">
                    <h5 class="fw-bold mb-1" style="color: #3E2723;">Inclusions &amp; Exclusions</h5>
                    <p class="text-muted small mb-4"><i class="fas fa-info-circle me-1"></i>Just type <strong>one item per line</strong> — no code needed.</p>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-dark"><i class="fas fa-check-circle text-success me-1"></i>What's Included</label>
                            <textarea name="inclusions" id="editor-inclusions" class="form-control friendly-list" rows="8" placeholder="Park fees&#10;Professional safari guide&#10;All meals">{{ old('inclusions', is_array($package->inclusions) ? implode("\n", $package->inclusions) : $package->inclusions) }}</textarea>
                            <small class="text-muted">One item per line.</small>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-dark"><i class="fas fa-times-circle text-danger me-1"></i>What's Excluded</label>
                            <textarea name="exclusions" id="editor-exclusions" class="form-control friendly-list" rows="8" placeholder="International flights&#10;Visa fees&#10;Tips">{{ old('exclusions', is_array($package->exclusions) ? implode("\n", $package->exclusions) : $package->exclusions) }}</textarea>
                            <small class="text-muted">One item per line.</small>
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
                    <div class="image-upload-wrapper border rounded-4 p-3 text-center position-relative" id="dropZone" style="background-color: #fdfaf5; border-style: dashed !important; transition: all .2s ease;">
                        <input type="file" name="image" id="packageImage" class="position-absolute opacity-0 w-100 h-100 top-0 start-0 cursor-pointer" accept="image/jpeg,image/png,image/webp,image/gif">
                        @if($package->image)
                        <div id="imagePreview" class="py-4 d-none">
                            <i class="fas fa-cloud-upload-alt fa-3x mb-3" style="color: #deb887;"></i>
                            <p class="mb-0 small text-muted fw-bold">Click to change or drag &amp; drop</p>
                        </div>
                        <img id="previewImg" src="{{ asset($package->image) }}" class="img-fluid rounded-3 shadow-sm" alt="Preview" style="max-height: 220px;">
                        @else
                        <div id="imagePreview" class="py-4">
                            <i class="fas fa-cloud-upload-alt fa-3x mb-3" style="color: #deb887;"></i>
                            <p class="mb-0 small text-muted fw-bold">Click to upload or drag &amp; drop</p>
                        </div>
                        <img id="previewImg" src="#" class="img-fluid rounded-3 d-none shadow-sm" alt="Preview" style="max-height: 220px;">
                        @endif
                        <p id="fileName" class="small text-success fw-bold mt-2 mb-0 d-none"></p>
                    </div>
                    <p class="smaller text-muted mt-1 text-center">JPG, PNG, WEBP or GIF · Max 2MB · 1200×800px recommended</p>
                    <div id="imageError" class="text-danger small mt-1 d-none"></div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const editorConfig = {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
    };

    let descriptionEditor, itineraryEditor;

    // Rich-text editor for the description only. Inclusions/exclusions are now
    // simple "one item per line" lists (converted to JSON on submit below).
    ClassicEditor.create(document.querySelector('#editor-description'), editorConfig)
        .then(editor => descriptionEditor = editor)
        .catch(error => console.error(error));

    // Itinerary mode toggle
    const itineraryTextarea = document.querySelector('#editor-itinerary');
    const itineraryCkeditorContainer = document.querySelector('#itinerary-ckeditor');
    const itineraryJsonRadio = document.querySelector('#itinerary_json');
    const itineraryTextRadio = document.querySelector('#itinerary_text');
    let itineraryMode = 'json';

    itineraryJsonRadio.addEventListener('change', function() {
        if (this.checked) {
            itineraryMode = 'json';
            if (itineraryEditor) {
                itineraryEditor.getData().then(data => {
                    itineraryTextarea.value = data;
                    itineraryEditor.destroy();
                    itineraryEditor = null;
                });
            }
            itineraryTextarea.classList.remove('d-none');
            itineraryCkeditorContainer.classList.add('d-none');
        }
    });

    itineraryTextRadio.addEventListener('change', function() {
        if (this.checked) {
            itineraryMode = 'text';
            itineraryTextarea.classList.add('d-none');
            itineraryCkeditorContainer.classList.remove('d-none');
            
            const textareaValue = itineraryTextarea.value;
            itineraryCkeditorContainer.innerHTML = '<textarea id="itinerary-ckeditor-instance"></textarea>';
            
            ClassicEditor.create(document.querySelector('#itinerary-ckeditor-instance'), editorConfig)
                .then(editor => {
                    itineraryEditor = editor;
                    editor.setData(textareaValue);
                })
                .catch(error => console.error(error));
        }
    });

    // --- Friendly image upload: drag & drop + client-side validation ---
    (function() {
        const input = document.getElementById('packageImage');
        const dropZone = document.getElementById('dropZone');
        const preview = document.getElementById('previewImg');
        const prompt = document.getElementById('imagePreview');
        const fileName = document.getElementById('fileName');
        const errorBox = document.getElementById('imageError');
        const MAX = 2 * 1024 * 1024;
        const OK_TYPES = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

        function showError(msg) {
            errorBox.textContent = msg;
            errorBox.classList.remove('d-none');
            fileName.classList.add('d-none');
            input.value = '';
        }

        function handleFile(file) {
            errorBox.classList.add('d-none');
            if (!file) return;
            if (OK_TYPES.indexOf(file.type) === -1) {
                return showError('Unsupported format. Please use JPG, PNG, WEBP or GIF.');
            }
            if (file.size > MAX) {
                return showError('Image is ' + (file.size / 1048576).toFixed(1) + 'MB — please use one under 2MB.');
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                if (prompt) prompt.classList.add('d-none');
                fileName.textContent = '✓ ' + file.name;
                fileName.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }

        input.addEventListener('change', function(e) { handleFile(e.target.files[0]); });

        ['dragenter', 'dragover'].forEach(function(evt) {
            dropZone.addEventListener(evt, function(e) {
                e.preventDefault(); e.stopPropagation();
                dropZone.style.borderColor = '#8b4513';
                dropZone.style.backgroundColor = '#f3e9dc';
            });
        });
        ['dragleave', 'drop'].forEach(function(evt) {
            dropZone.addEventListener(evt, function(e) {
                e.preventDefault(); e.stopPropagation();
                dropZone.style.borderColor = '';
                dropZone.style.backgroundColor = '#fdfaf5';
            });
        });
        dropZone.addEventListener('drop', function(e) {
            const file = e.dataTransfer.files[0];
            if (file) { input.files = e.dataTransfer.files; handleFile(file); }
        });
    })();

    // AJAX form submission
    document.getElementById('editSafariForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get editor data for CKEditor fields
        const formData = new FormData(this);
        formData.set('description', descriptionEditor.getData());

        // Convert "one item per line" lists into a JSON array (backend format).
        ['inclusions', 'exclusions'].forEach(function(field) {
            const ta = document.getElementById('editor-' + field);
            if (!ta) return;
            const raw = ta.value.trim();
            let val = '[]';
            if (raw) {
                if (raw.charAt(0) === '[') {
                    try { JSON.parse(raw); val = raw; }
                    catch (e) { val = JSON.stringify(raw.split(/\r?\n/).map(function(s){return s.trim();}).filter(Boolean)); }
                } else {
                    val = JSON.stringify(raw.split(/\r?\n/).map(function(s){return s.trim();}).filter(Boolean));
                }
            }
            formData.set(field, val);
        });
        
        // Get itinerary data based on mode
        if (itineraryMode === 'text' && itineraryEditor) {
            itineraryEditor.getData().then(data => {
                formData.set('itinerary', data);
                submitForm(formData);
            });
        } else {
            const itineraryValue = document.querySelector('#editor-itinerary').value;
            formData.set('itinerary', itineraryValue);
            submitForm(formData);
        }
    });

    function submitForm(formData) {
        // Show loading
        Swal.fire({
            title: 'Updating...',
            text: 'Please wait while we update the package',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Send AJAX request
        fetch(document.getElementById('editSafariForm').action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.text())
        .then(html => {
            // Check if redirected (success)
            if (html.includes('Safari package updated successfully')) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Safari package has been updated successfully.',
                    icon: 'success',
                    confirmButtonColor: '#8b4513',
                    confirmButtonText: '<i class="fas fa-check me-2"></i>OK',
                    customClass: {
                        confirmButton: 'rounded-pill px-4'
                    }
                }).then(() => {
                    window.location.href = '{{ route("admin.safaris") }}';
                });
            } else {
                // Show error page or validation errors
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error updating the package. Please check the form for errors.',
                    icon: 'error',
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: '<i class="fas fa-times me-2"></i>OK',
                    customClass: {
                        confirmButton: 'rounded-pill px-4'
                    }
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred while updating the package.',
                icon: 'error',
                confirmButtonColor: '#dc3545',
                confirmButtonText: '<i class="fas fa-times me-2"></i>OK',
                customClass: {
                    confirmButton: 'rounded-pill px-4'
                }
            });
        });
    }
</script>
<style>
    .ck-editor__editable { min-height: 200px; }
    .cursor-pointer { cursor: pointer; }
    
    /* SweetAlert custom styles */
    .swal2-popup {
        border-radius: 1rem !important;
    }
    .swal2-title {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    }
    .swal2-content {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    }
</style>
@endpush
@endsection
