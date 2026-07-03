{{-- Shared create/edit form — matches the standard admin form style. Expects: $action, $method, $categories, optional $item. --}}
<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(($method ?? 'POST') === 'PUT') @method('PUT') @endif

    <div class="row g-4">
        <div class="col-md-6">
            <label class="form-label fw-bold">Section</label>
            <select name="category" class="form-select rounded-3 @error('category') is-invalid @enderror" required>
                <option value="">Choose a section…</option>
                @foreach($categories as $key => $label)
                    <option value="{{ $key }}" @selected(old('category', $item->category ?? '') === $key)>{{ $label }}</option>
                @endforeach
            </select>
            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-6">
            <label class="form-label fw-bold">Title</label>
            <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" class="form-control rounded-3 @error('title') is-invalid @enderror" required>
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-12">
            <label class="form-label fw-bold">Description</label>
            <textarea name="description" class="form-control rounded-3" rows="3">{{ old('description', $item->description ?? '') }}</textarea>
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Icon Class</label>
            <input type="text" name="icon" value="{{ old('icon', $item->icon ?? 'fa-umbrella-beach') }}" class="form-control rounded-3" placeholder="FontAwesome icon class">
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Price (USD) <small class="text-muted fw-normal">packages</small></label>
            <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $item->price ?? '') }}" class="form-control rounded-3" placeholder="e.g. 899">
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Duration <small class="text-muted fw-normal">packages</small></label>
            <input type="text" name="duration" value="{{ old('duration', $item->duration ?? '') }}" class="form-control rounded-3" placeholder="e.g. 5 Days / 4 Nights">
        </div>

        <div class="col-md-6">
            <label class="form-label fw-bold">Best Time <small class="text-muted fw-normal">beaches</small></label>
            <input type="text" name="best_time" value="{{ old('best_time', $item->best_time ?? '') }}" class="form-control rounded-3" placeholder="e.g. Jun – Oct, Dec – Feb">
        </div>

        <div class="col-md-6">
            <label class="form-label fw-bold">Display Order</label>
            <input type="number" min="0" name="display_order" value="{{ old('display_order', $item->display_order ?? 0) }}" class="form-control rounded-3">
        </div>

        <div class="col-12">
            <label class="form-label fw-bold">Details <small class="text-muted fw-normal">(one item per line — activities or package inclusions)</small></label>
            <textarea name="details" class="form-control rounded-3" rows="4" placeholder="Sunset dhow cruise&#10;Diving &amp; snorkelling&#10;Turtle aquarium">{{ old('details', $item->details ?? '') }}</textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-bold">Image</label>
            @if(isset($item) && $item->image_url)
            <div class="mb-2">
                <img src="{{ $item->image_url }}" class="rounded-3" style="width: 100px; height: 100px; object-fit: cover;" alt="">
            </div>
            @endif
            <input type="file" name="image" class="form-control rounded-3 @error('image') is-invalid @enderror" accept="image/*">
            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <small class="text-muted">JPG, PNG or WebP · max 4&nbsp;MB.</small>
        </div>

        <div class="col-md-6 d-flex align-items-center">
            <div class="form-check mt-3">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="active" @checked(old('is_active', $item->is_active ?? true))>
                <label class="form-check-label fw-bold" for="active">Active (visible on the site)</label>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-lg rounded-pill px-5 fw-bold" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
            <i class="fas fa-save me-2"></i>{{ isset($item) ? 'Update Item' : 'Create Item' }}
        </button>
        <a href="{{ route('admin.zanzibar.index') }}" class="btn btn-lg btn-outline-dark rounded-pill px-4 ms-2">Cancel</a>
    </div>
</form>
