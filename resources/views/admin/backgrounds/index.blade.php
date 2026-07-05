@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #3E2723;">
                <i class="fas fa-image me-2" style="color: #8B4513;"></i>Page Backgrounds
            </h2>
            <p class="text-muted mb-0">Change the big banner photo at the top of each page. Upload a new image or paste an image link, then Save.</p>
        </div>
    </div>

    @if(session('success'))<div class="alert alert-success rounded-4">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger rounded-4">{{ session('error') }}</div>@endif
    @if($errors->any())
    <div class="alert alert-danger rounded-4">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <div class="alert alert-info rounded-4 small">
        <i class="fas fa-circle-info me-1"></i>
        For best results use a wide photo (about <strong>1920&times;1080</strong>), landscape, under 8&nbsp;MB (JPG, PNG or WebP).
        After saving, if you don't see the change straight away, open <a href="{{ route('admin.settings') }}">Settings</a> and click <strong>Clear Cache</strong>.
    </div>

    <form action="{{ route('admin.backgrounds.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @foreach(collect($items)->groupBy('page') as $page => $group)
        <div class="card border-0 rounded-4 shadow-sm mb-4">
            <div class="card-header bg-white border-0 pt-3 pb-0 px-4">
                <h5 class="fw-bold mb-0" style="color: #3E2723;">{{ $page }}</h5>
            </div>
            <div class="card-body p-4">
                @foreach($group as $item)
                <div class="row align-items-center g-3 py-3 {{ ! $loop->last ? 'border-bottom' : '' }}">
                    {{-- Preview --}}
                    <div class="col-md-4">
                        <div class="rounded-3 overflow-hidden border" style="aspect-ratio: 16/9; background:#f2efec;">
                            <img src="{{ $item['current'] }}" alt="{{ $item['label'] }}"
                                 style="width:100%; height:100%; object-fit:cover;">
                        </div>
                        <div class="small mt-1">
                            @if($item['is_custom'])
                                <span class="badge bg-success-subtle text-success"><i class="fas fa-check me-1"></i>Custom image set</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">Using default image</span>
                            @endif
                        </div>
                    </div>

                    {{-- Controls --}}
                    <div class="col-md-8">
                        <label class="fw-semibold mb-2" style="color:#3E2723;">{{ $item['label'] }}</label>

                        <div class="mb-2">
                            <label class="form-label small text-muted mb-1">Upload a new image from your computer</label>
                            <input type="file" name="{{ $item['key'] }}" accept="image/*" class="form-control rounded-3">
                        </div>

                        <div class="mb-2">
                            <label class="form-label small text-muted mb-1">…or paste an image link (URL)</label>
                            @php($raw = \App\Models\SiteSetting::get($item['key']))
                            <input type="url" name="{{ $item['key'] }}_url" class="form-control rounded-3"
                                   placeholder="https://…" value="{{ \Illuminate\Support\Str::startsWith((string) $raw, ['http://','https://']) ? $raw : '' }}">
                        </div>

                        @if($item['is_custom'])
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="{{ $item['key'] }}_reset" id="reset_{{ $item['key'] }}" value="1">
                            <label class="form-check-label small text-muted" for="reset_{{ $item['key'] }}">
                                Remove my image and go back to the original default
                            </label>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        <div class="d-flex justify-content-end mb-5">
            <button type="submit" class="btn btn-lg rounded-pill px-5 fw-bold"
                    style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%); color: white;">
                <i class="fas fa-save me-2"></i>Save Backgrounds
            </button>
        </div>
    </form>
</div>
@endsection
