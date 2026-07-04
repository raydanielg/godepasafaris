@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <a href="{{ route('admin.cultural.index') }}" class="btn btn-outline-secondary rounded-pill"><i class="fas fa-arrow-left me-2"></i>Back</a>
    </div>

    <div class="card border-0 rounded-4 shadow-sm mb-4">
        <div class="card-header bg-white py-4 border-0">
            <h4 class="fw-bold mb-0" style="color: #3E2723;"><i class="fas fa-pen me-2" style="color: #8B4513;"></i>Edit: {{ $item->name }}</h4>
        </div>
        <div class="card-body p-4">
            @include('admin.cultural._form', ['action' => route('admin.cultural.update', $item), 'method' => 'PUT', 'item' => $item])
        </div>
    </div>

    <!-- Reviews management -->
    <div class="card border-0 rounded-4 shadow-sm">
        <div class="card-header bg-white py-4 border-0">
            <h5 class="fw-bold mb-0" style="color: #3E2723;"><i class="fas fa-star me-2" style="color: #8B4513;"></i>Visitor Reviews ({{ $item->reviews->count() }})</h5>
        </div>
        <div class="card-body p-4">
            @forelse($item->reviews as $rev)
            <div class="d-flex justify-content-between align-items-start border-bottom py-3">
                <div>
                    <div class="mb-1">
                        <span class="fw-bold" style="color:#3E2723;">{{ $rev->name }}</span>
                        @if($rev->location)<small class="text-muted">· {{ $rev->location }}</small>@endif
                        <span class="ms-2">@for($i=0;$i<5;$i++)<i class="fas fa-star {{ $i < $rev->rating ? 'text-warning' : 'text-muted opacity-25' }}" style="font-size:.8rem;"></i>@endfor</span>
                    </div>
                    <p class="text-muted small mb-0">{{ $rev->comment }}</p>
                </div>
                <form action="{{ route('admin.cultural.reviews.destroy', $rev) }}" method="POST" onsubmit="return confirm('Delete this review?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger rounded-pill"><i class="fas fa-trash"></i></button>
                </form>
            </div>
            @empty
            <p class="text-muted small">No reviews yet.</p>
            @endforelse

            <form action="{{ route('admin.cultural.reviews.store', $item) }}" method="POST" class="row g-3 mt-2">
                @csrf
                <div class="col-md-4"><input type="text" name="name" class="form-control rounded-3" placeholder="Reviewer name" required></div>
                <div class="col-md-4"><input type="text" name="location" class="form-control rounded-3" placeholder="Country / city"></div>
                <div class="col-md-4">
                    <select name="rating" class="form-select rounded-3">
                        @for($i=5;$i>=1;$i--)<option value="{{ $i }}">{{ $i }} star{{ $i>1?'s':'' }}</option>@endfor
                    </select>
                </div>
                <div class="col-12"><textarea name="comment" class="form-control rounded-3" rows="2" placeholder="Review comment" required></textarea></div>
                <div class="col-12">
                    <button class="btn rounded-pill px-4 fw-bold text-white" style="background:#8B4513;"><i class="fas fa-plus me-2"></i>Add Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
