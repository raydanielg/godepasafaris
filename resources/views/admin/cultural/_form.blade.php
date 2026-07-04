{{-- Shared create/edit form. Expects: $action, $method, optional $item. --}}
<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(($method ?? 'POST') === 'PUT') @method('PUT') @endif

    <div class="row g-4">
        <div class="col-md-6">
            <label class="form-label fw-bold">Name</label>
            <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" class="form-control rounded-3 @error('name') is-invalid @enderror" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-3">
            <label class="form-label fw-bold">Tribe / Group</label>
            <input type="text" name="tribe" value="{{ old('tribe', $item->tribe ?? '') }}" class="form-control rounded-3" placeholder="e.g. Maasai">
        </div>
        <div class="col-md-3">
            <label class="form-label fw-bold">Region</label>
            <input type="text" name="region" value="{{ old('region', $item->region ?? '') }}" class="form-control rounded-3" placeholder="e.g. Arusha · Ngorongoro">
        </div>

        <div class="col-12">
            <label class="form-label fw-bold">Tagline</label>
            <input type="text" name="tagline" value="{{ old('tagline', $item->tagline ?? '') }}" class="form-control rounded-3" placeholder="Short one-line summary">
        </div>

        <div class="col-12">
            <label class="form-label fw-bold">Description</label>
            <textarea name="description" id="editor-description" class="form-control rounded-3" rows="5">{{ old('description', $item->description ?? '') }}</textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-bold">Highlights <small class="text-muted fw-normal">(one per line)</small></label>
            <textarea name="highlights" class="form-control rounded-3" rows="4" placeholder="Authentic boma visit&#10;Warrior dance">{{ old('highlights', $item->highlights ?? '') }}</textarea>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Activities <small class="text-muted fw-normal">(one per line)</small></label>
            <textarea name="activities" class="form-control rounded-3" rows="4" placeholder="Traditional dances&#10;Village visits">{{ old('activities', $item->activities ?? '') }}</textarea>
        </div>

        <div class="col-md-3">
            <label class="form-label fw-bold">Price (USD)</label>
            <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $item->price ?? '') }}" class="form-control rounded-3" placeholder="e.g. 45">
        </div>
        <div class="col-md-3">
            <label class="form-label fw-bold">Duration</label>
            <input type="text" name="duration" value="{{ old('duration', $item->duration ?? '') }}" class="form-control rounded-3" placeholder="e.g. Half day">
        </div>
        <div class="col-md-3">
            <label class="form-label fw-bold">Best Time</label>
            <input type="text" name="best_time" value="{{ old('best_time', $item->best_time ?? '') }}" class="form-control rounded-3" placeholder="e.g. All year">
        </div>
        <div class="col-md-3">
            <label class="form-label fw-bold">Icon</label>
            <input type="text" name="icon" value="{{ old('icon', $item->icon ?? 'fa-people-group') }}" class="form-control rounded-3">
        </div>

        <div class="col-md-6">
            <label class="form-label fw-bold">Main / Banner Image</label>
            @if(isset($item) && $item->image_url)
            <div class="mb-2"><img src="{{ $item->image_url }}" class="rounded-3" style="width: 120px; height: 90px; object-fit: cover;" alt=""></div>
            @endif
            <input type="file" name="image" class="form-control rounded-3 @error('image') is-invalid @enderror" accept="image/*">
            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <small class="text-muted">JPG, PNG or WebP · max 4&nbsp;MB.</small>
        </div>

        <div class="col-md-3">
            <label class="form-label fw-bold">Display Order</label>
            <input type="number" min="0" name="display_order" value="{{ old('display_order', $item->display_order ?? 0) }}" class="form-control rounded-3">
        </div>
        <div class="col-md-3 d-flex align-items-center">
            <div class="mt-3">
                <div class="form-check">
                    <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="feat" @checked(old('is_featured', $item->is_featured ?? false))>
                    <label class="form-check-label fw-bold" for="feat">Featured</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="is_active" value="1" class="form-check-input" id="active" @checked(old('is_active', $item->is_active ?? true))>
                    <label class="form-check-label fw-bold" for="active">Active</label>
                </div>
            </div>
        </div>

        <div class="col-12">
            <label class="form-label fw-bold">Gallery Images</label>
            @if(isset($item) && count($item->gallery_urls))
            <div class="d-flex flex-wrap gap-3 mb-2">
                @foreach($item->gallery as $g)
                <div class="text-center">
                    <img src="{{ \App\Models\CulturalExperience::url($g) }}" class="rounded-3 d-block" style="width: 100px; height: 75px; object-fit: cover;" alt="">
                    <div class="form-check mt-1">
                        <input type="checkbox" name="remove_gallery[]" value="{{ $g }}" class="form-check-input" id="rm{{ $loop->index }}">
                        <label class="form-check-label small text-danger" for="rm{{ $loop->index }}">Remove</label>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            <input type="file" name="gallery[]" class="form-control rounded-3" accept="image/*" multiple>
            <small class="text-muted">Select multiple images to add to the gallery.</small>
        </div>

        <div class="col-12"><hr class="my-1"><h6 class="fw-bold text-muted mb-0"><i class="fas fa-magnifying-glass me-2"></i>SEO (optional — leave blank to auto-generate)</h6></div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $item->meta_title ?? '') }}" class="form-control rounded-3" maxlength="255" placeholder="Custom title for search engines / browser tab">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Meta Description</label>
            <input type="text" name="meta_description" value="{{ old('meta_description', $item->meta_description ?? '') }}" class="form-control rounded-3" maxlength="500" placeholder="Short description shown in search results">
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
            <i class="fas fa-save me-2"></i>{{ isset($item) ? 'Update Experience' : 'Create Experience' }}
        </button>
        <a href="{{ route('admin.cultural.index') }}" class="btn btn-lg btn-outline-dark rounded-pill px-4 ms-2">Cancel</a>
    </div>
</form>
