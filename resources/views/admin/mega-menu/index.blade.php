@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #3E2723;">
                <i class="fas fa-bars me-2" style="color: #8B4513;"></i>Mega Menu Manager
            </h2>
            <p class="text-muted mb-0">Edit what appears in the big drop-down menus at the top of the website — the picture card on the right and the shortcut links on the left.</p>
        </div>
    </div>

    @if(session('success'))<div class="alert alert-success rounded-4">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger rounded-4">{{ session('error') }}</div>@endif
    @if($errors->any())
    <div class="alert alert-danger rounded-4">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    {{-- ---------------------------------------------------------------- --}}
    {{-- Category selector: which nav drop-down are we editing?           --}}
    {{-- ---------------------------------------------------------------- --}}
    <div class="card border-0 rounded-4 shadow-sm mb-4">
        <div class="card-body p-4">
            <label class="form-label small fw-bold text-muted text-uppercase">Navigation Category</label>
            <div class="d-flex flex-wrap gap-2">
                @foreach($navItems as $key => $label)
                <a href="{{ route('admin.mega-menu', ['section' => $key]) }}"
                   class="btn rounded-pill px-4 {{ $navItem === $key ? 'text-white' : 'btn-outline-secondary' }}"
                   @if($navItem === $key) style="background: #8B4513; border-color: #8B4513;" @endif>
                    {{ $label }}
                </a>
                @endforeach
            </div>
            <div class="form-text mt-2">Pick a menu to edit. Changes go live on the website as soon as you save.</div>
        </div>
    </div>

    <div class="row g-4">
        {{-- ------------------------------------------------------------ --}}
        {{-- Feature card editor (right-hand side of the mega menu)       --}}
        {{-- ------------------------------------------------------------ --}}
        <div class="col-xl-5">
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-header border-0 py-3 d-flex align-items-center" style="background-color: #8B4513;">
                    <i class="fas fa-id-card text-white me-2"></i>
                    <h6 class="m-0 fw-bold text-white">Feature Card — {{ $navItems[$navItem] }}</h6>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.mega-menu.section.update', $section) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Image: preview, upload, paste URL, or remove --}}
                        <label class="form-label small fw-bold text-muted text-uppercase">Image</label>
                        <div class="rounded-3 overflow-hidden border mb-2" style="aspect-ratio: 16/10; background:#f2efec;">
                            @if($section->image_url)
                                <img src="{{ $section->image_url }}" alt="{{ $section->title }}" style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 text-muted small text-center px-3">
                                    <span><i class="fas fa-image d-block fs-3 mb-2 opacity-50"></i>No image set — the menu falls back to its built-in picture.</span>
                                </div>
                            @endif
                        </div>

                        <input type="file" name="image" class="form-control rounded-3 mb-2" accept="image/jpeg,image/png,image/webp">
                        <div class="form-text mb-2">JPG, PNG or WebP, up to 4&nbsp;MB. Landscape works best (about 600&times;400).</div>

                        <input type="url" name="image_url" class="form-control rounded-3 mb-2" placeholder="…or paste an image link (https://…)">

                        @if($section->image)
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="removeImage">
                            <label class="form-check-label small" for="removeImage">Remove the current image</label>
                        </div>
                        @endif

                        <hr class="my-3">

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Title</label>
                            <input type="text" name="title" class="form-control rounded-3" required maxlength="255"
                                   value="{{ old('title', $section->title) }}" style="background-color: #fdfaf5;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Description</label>
                            <textarea name="description" rows="3" class="form-control rounded-3" maxlength="2000"
                                      style="background-color: #fdfaf5;">{{ old('description', $section->description) }}</textarea>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-7">
                                <label class="form-label small fw-bold text-muted text-uppercase">Badge</label>
                                <input type="text" name="badge" class="form-control rounded-3" maxlength="60"
                                       value="{{ old('badge', $section->badge) }}" placeholder="e.g. 52 Reasons" style="background-color: #fdfaf5;">
                            </div>
                            <div class="col-5">
                                <label class="form-label small fw-bold text-muted text-uppercase">Colour</label>
                                <select name="badge_color" class="form-select rounded-3" style="background-color: #fdfaf5;">
                                    @foreach($colors as $c)
                                    <option value="{{ $c }}" @selected(old('badge_color', $section->badge_color) === $c)>{{ ucfirst($c) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Button Text</label>
                            <input type="text" name="link_text" class="form-control rounded-3" maxlength="80"
                                   value="{{ old('link_text', $section->link_text) }}" placeholder="e.g. Explore Kilimanjaro" style="background-color: #fdfaf5;">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Button Link</label>
                            <input type="text" name="link_url" class="form-control rounded-3" maxlength="255"
                                   value="{{ old('link_url', $section->link_url) }}" placeholder="/kilimanjaro" style="background-color: #fdfaf5;">
                            <div class="form-text">A page on this site starts with <code>/</code>. External links must start with <code>https://</code>.</div>
                        </div>

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="sectionActive"
                                   @checked(old('is_active', $section->is_active))>
                            <label class="form-check-label small fw-bold" for="sectionActive">Show this drop-down menu</label>
                        </div>

                        {{-- Only meaningful where the menu can also build itself from live content. --}}
                        @if(in_array($navItem, ['safari', 'destinations'], true))
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="use_custom_content" value="1" id="useCustomContent"
                                   @checked(old('use_custom_content', $section->use_custom_content))>
                            <label class="form-check-label small fw-bold" for="useCustomContent">Manage this menu myself</label>
                            <div class="form-text">
                                <strong>Off</strong> (current) &mdash; the menu builds itself automatically from your
                                {{ $navItem === 'safari' ? 'safari packages' : 'destinations' }}, so new ones appear on their own.<br>
                                <strong>On</strong> &mdash; the menu shows exactly the feature card and shortcut links you set here.
                            </div>
                        </div>
                        @endif

                        <button type="submit" class="btn w-100 py-2 rounded-pill fw-bold text-white" style="background: #8B4513;">
                            <i class="fas fa-save me-2"></i>Save Feature Card
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ------------------------------------------------------------ --}}
        {{-- Shortcut links (left-hand side of the mega menu)             --}}
        {{-- ------------------------------------------------------------ --}}
        <div class="col-xl-7">
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-header border-0 py-3 d-flex align-items-center justify-content-between" style="background-color: #5d4037;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-link text-white me-2"></i>
                        <h6 class="m-0 fw-bold text-white">Shortcut Links — {{ $navItems[$navItem] }}</h6>
                    </div>
                    <span class="badge bg-light text-dark rounded-pill">{{ $links->count() }}</span>
                </div>
                <div class="card-body p-4">

                    @if(in_array($navItem, ['safari', 'destinations'], true) && ! $section->use_custom_content)
                    <div class="alert alert-info rounded-4 small">
                        <i class="fas fa-circle-info me-1"></i>
                        This menu currently builds itself <strong>automatically</strong> from your
                        {{ $navItem === 'safari' ? 'safari packages' : 'destinations' }}.
                        The links below are saved but not shown on the desktop menu yet &mdash; switch on
                        <strong>“Manage this menu myself”</strong> to take control.
                        <em>(They are already used by the phone menu.)</em>
                    </div>
                    @endif

                    @forelse($links as $link)
                    <div class="border rounded-4 p-3 mb-3 {{ $link->is_active ? '' : 'bg-light opacity-75' }}">
                        <form action="{{ route('admin.mega-menu.links.update', $link) }}" method="POST" id="editLink{{ $link->id }}">
                            @csrf
                            @method('PUT')

                            <div class="d-flex align-items-center mb-2">
                                <span class="badge rounded-pill me-2" style="background:#8B4513;">{{ $loop->iteration }}</span>
                                <i class="fas {{ $link->icon ?: 'fa-link' }} me-2" style="color:#8B4513;"></i>
                                <strong class="me-auto" style="color:#3E2723;">{{ $link->title }}</strong>
                                @unless($link->is_active)
                                    <span class="badge bg-secondary rounded-pill">Hidden</span>
                                @endunless
                            </div>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Label</label>
                                    <input type="text" name="title" class="form-control form-control-sm rounded-3" required maxlength="255" value="{{ $link->title }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Subtitle</label>
                                    <input type="text" name="description" class="form-control form-control-sm rounded-3" maxlength="255" value="{{ $link->description }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">URL</label>
                                    <input type="text" name="url" class="form-control form-control-sm rounded-3" required maxlength="255" value="{{ $link->url }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Icon</label>
                                    <input type="text" name="icon" class="form-control form-control-sm rounded-3" maxlength="60" value="{{ $link->icon }}" placeholder="fa-mountain">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label small text-muted mb-1">Badge</label>
                                    <input type="text" name="badge" class="form-control form-control-sm rounded-3" maxlength="40" value="{{ $link->badge }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted mb-1">Badge Colour</label>
                                    <select name="badge_color" class="form-select form-select-sm rounded-3">
                                        @foreach($colors as $c)
                                        <option value="{{ $c }}" @selected($link->badge_color === $c)>{{ ucfirst($c) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <div class="form-check form-switch mb-1">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="link{{ $link->id }}" @checked($link->is_active)>
                                        <label class="form-check-label small" for="link{{ $link->id }}">Visible</label>
                                    </div>
                                </div>
                            </div>

                        </form>

                        {{-- Action row. The Save button is bound to the edit form above via
                             form="…" so these sibling forms never nest inside it. --}}
                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" form="editLink{{ $link->id }}" class="btn btn-sm rounded-pill px-3 text-white" style="background:#8B4513;">
                                <i class="fas fa-save me-1"></i>Save
                            </button>

                            <form action="{{ route('admin.mega-menu.links.move', $link) }}" method="POST">
                                @csrf
                                <input type="hidden" name="direction" value="up">
                                <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3" @disabled($loop->first) title="Move up">
                                    <i class="fas fa-arrow-up"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.mega-menu.links.move', $link) }}" method="POST">
                                @csrf
                                <input type="hidden" name="direction" value="down">
                                <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3" @disabled($loop->last) title="Move down">
                                    <i class="fas fa-arrow-down"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.mega-menu.links.toggle', $link) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="fas {{ $link->is_active ? 'fa-eye-slash' : 'fa-eye' }} me-1"></i>{{ $link->is_active ? 'Hide' : 'Show' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.mega-menu.links.destroy', $link) }}" method="POST" class="ms-auto"
                                  onsubmit="return confirm('Delete this shortcut from the menu? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fas fa-trash-alt me-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <p class="text-muted text-center py-4 mb-0">No shortcut links yet. Add the first one below.</p>
                    @endforelse

                    {{-- Add new --}}
                    <div class="border rounded-4 p-3 mt-4" style="background:#fdfaf5;">
                        <h6 class="fw-bold mb-3" style="color:#3E2723;"><i class="fas fa-plus me-2" style="color:#8B4513;"></i>Add Shortcut</h6>
                        <form action="{{ route('admin.mega-menu.links.store', $section) }}" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Label</label>
                                    <input type="text" name="title" class="form-control form-control-sm rounded-3" required maxlength="255" placeholder="Machame Route">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Subtitle</label>
                                    <input type="text" name="description" class="form-control form-control-sm rounded-3" maxlength="255" placeholder="Scenic 7-day adventure">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">URL</label>
                                    <input type="text" name="url" class="form-control form-control-sm rounded-3" required maxlength="255" placeholder="/kilimanjaro/routes">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Icon</label>
                                    <input type="text" name="icon" class="form-control form-control-sm rounded-3" maxlength="60" placeholder="fa-mountain">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label small text-muted mb-1">Badge</label>
                                    <input type="text" name="badge" class="form-control form-control-sm rounded-3" maxlength="40" placeholder="Popular">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted mb-1">Badge Colour</label>
                                    <select name="badge_color" class="form-select form-select-sm rounded-3">
                                        @foreach($colors as $c)
                                        <option value="{{ $c }}" @selected($c === 'secondary')>{{ ucfirst($c) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <div class="form-check form-switch mb-1">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="newLinkActive" checked>
                                        <label class="form-check-label small" for="newLinkActive">Visible</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm rounded-pill px-4 mt-3 text-white" style="background:#5d4037;">
                                <i class="fas fa-plus me-1"></i>Add Shortcut
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
