{{-- Shared create/edit form. Expects: $action, $method, $categories, and optional $item. --}}
<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(($method ?? 'POST') === 'PUT') @method('PUT') @endif

    <div class="row g-4">
        <div class="col-md-6">
            <label class="form-label fw-bold">Section / Category</label>
            <select name="category" class="form-select form-select-lg rounded-3 @error('category') is-invalid @enderror" required>
                <option value="">Choose a section…</option>
                @foreach($categories as $key => $label)
                    <option value="{{ $key }}" @selected(old('category', $item->category ?? '') === $key)>{{ $label }}</option>
                @endforeach
            </select>
            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-6">
            <label class="form-label fw-bold">Title</label>
            <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror" required>
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-12">
            <label class="form-label fw-bold">Description</label>
            <textarea name="description" rows="3" class="form-control rounded-3">{{ old('description', $item->description ?? '') }}</textarea>
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Icon <small class="text-muted fw-normal">(Font Awesome)</small></label>
            <input type="text" name="icon" value="{{ old('icon', $item->icon ?? 'fa-umbrella-beach') }}" class="form-control rounded-3" placeholder="fa-umbrella-beach">
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
            <label class="form-label fw-bold">Details <small class="text-muted fw-normal">(one per line — activities or package inclusions)</small></label>
            <textarea name="details" rows="4" class="form-control rounded-3" placeholder="Sunset dhow cruise&#10;Diving & snorkelling&#10;Turtle aquarium">{{ old('details', $item->details ?? '') }}</textarea>
        </div>

        <div class="col-12">
            <label class="form-label fw-bold">Image</label>
            <div id="dropzone" class="border border-2 border-dashed rounded-4 p-4 text-center" style="cursor:pointer; background:#fdfaf5; border-color:#d8c3a5 !important;">
                <input type="file" name="image" id="imageInput" class="d-none @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/webp">
                <div id="dropPrompt">
                    <i class="fas fa-cloud-arrow-up fa-2x mb-2" style="color:#8B4513;"></i>
                    <p class="mb-1 fw-bold" style="color:#3E2723;">Drag &amp; drop an image here, or click to browse</p>
                    <small class="text-muted">JPG, PNG or WebP · max 4&nbsp;MB</small>
                </div>
                <img id="imagePreview" src="{{ isset($item) && $item->image_url ? $item->image_url : '' }}" alt="Preview"
                     class="img-fluid rounded-3 mt-2 {{ isset($item) && $item->image_url ? '' : 'd-none' }}" style="max-height:220px;">
            </div>
            @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            @if(isset($item) && $item->image_url)
                <small class="text-muted">Upload a new file to replace the current image.</small>
            @endif
        </div>

        <div class="col-12">
            <div class="form-check form-check-inline">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="active" @checked(old('is_active', $item->is_active ?? true))>
                <label class="form-check-label fw-bold" for="active">Active (visible on the site)</label>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-lg rounded-pill px-5 fw-bold text-white" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
            <i class="fas fa-save me-2"></i>{{ isset($item) ? 'Update' : 'Create' }}
        </button>
        <a href="{{ route('admin.zanzibar.index') }}" class="btn btn-lg btn-outline-secondary rounded-pill px-4">Cancel</a>
    </div>
</form>

<script>
(function () {
    const zone = document.getElementById('dropzone');
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('imagePreview');
    const prompt = document.getElementById('dropPrompt');
    if (!zone || !input) return;

    const MAX = 4 * 1024 * 1024;

    function show(file) {
        if (!file) return;
        if (!/^image\/(jpeg|png|webp)$/.test(file.type)) { alert('Please choose a JPG, PNG or WebP image.'); return; }
        if (file.size > MAX) { alert('Image must be 4 MB or smaller.'); return; }
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.classList.remove('d-none'); prompt.classList.add('d-none'); };
        reader.readAsDataURL(file);
    }

    zone.addEventListener('click', () => input.click());
    input.addEventListener('change', () => show(input.files[0]));
    ['dragover', 'dragenter'].forEach(ev => zone.addEventListener(ev, e => { e.preventDefault(); zone.style.background = '#f3e9d8'; }));
    ['dragleave', 'drop'].forEach(ev => zone.addEventListener(ev, e => { e.preventDefault(); zone.style.background = '#fdfaf5'; }));
    zone.addEventListener('drop', e => { if (e.dataTransfer.files.length) { input.files = e.dataTransfer.files; show(input.files[0]); } });
})();
</script>
