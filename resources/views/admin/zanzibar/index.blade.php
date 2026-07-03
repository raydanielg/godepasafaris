@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h4 class="fw-bold mb-0" style="color: #3E2723;">
                <i class="fas fa-umbrella-beach me-2" style="color: #8B4513;"></i>Zanzibar Content
            </h4>
            <small class="text-muted">Manage every section of the Zanzibar page — beaches, culture, spices, marine, packages and more.</small>
        </div>
        <a href="{{ route('admin.zanzibar.create') }}" class="btn rounded-pill px-4 fw-bold text-white" style="background: linear-gradient(135deg, #8B4513 0%, #D2691E 100%);">
            <i class="fas fa-plus me-2"></i>Add Item
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success rounded-4 d-flex align-items-center">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
    @endif

    @forelse($categories as $key => $label)
        @php $group = $items[$key] ?? collect(); @endphp
        <div class="card border-0 rounded-4 shadow-sm mb-4">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                <h6 class="fw-bold mb-0" style="color:#3E2723;">{{ $label }}
                    <span class="badge rounded-pill ms-2" style="background:#8B4513;">{{ $group->count() }}</span>
                </h6>
            </div>
            <div class="card-body pt-0">
                @if($group->count())
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <tbody>
                            @foreach($group as $item)
                            <tr>
                                <td style="width:70px;">
                                    @if($item->image_url)
                                        <img src="{{ $item->image_url }}" class="rounded-3" style="width:56px;height:56px;object-fit:cover;" alt="">
                                    @else
                                        <span class="d-inline-flex align-items-center justify-content-center rounded-3" style="width:56px;height:56px;background:rgba(139,69,19,.1);">
                                            <i class="fas {{ $item->icon ?: 'fa-image' }}" style="color:#8B4513;"></i>
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold" style="color:#3E2723;">{{ $item->title }}</div>
                                    <small class="text-muted">{{ \Illuminate\Support\Str::limit($item->description, 70) }}</small>
                                    @if($item->price)<span class="badge bg-light text-dark border ms-1">${{ number_format($item->price, 0) }}</span>@endif
                                    @unless($item->is_active)<span class="badge bg-secondary ms-1">Hidden</span>@endunless
                                </td>
                                <td class="text-end" style="width:150px;">
                                    <a href="{{ route('admin.zanzibar.edit', $item) }}" class="btn btn-sm btn-outline-primary rounded-pill"><i class="fas fa-pen"></i></a>
                                    <form action="{{ route('admin.zanzibar.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete “{{ $item->title }}”?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger rounded-pill"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <p class="text-muted small mb-0">No items yet. <a href="{{ route('admin.zanzibar.create') }}">Add one</a>.</p>
                @endif
            </div>
        </div>
    @empty
        <p class="text-muted">No categories configured.</p>
    @endforelse
</div>
@endsection
