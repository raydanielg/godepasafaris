@extends('layouts.admin')

@section('title', 'Blog Posts')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Blog Posts</h3>
        <a href="#" class="btn btn-earth text-white rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-2"></i> Create Post
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4">Post</th>
                        <th class="border-0">Category</th>
                        <th class="border-0">Slug</th>
                        <th class="border-0">Date</th>
                        <th class="border-0 text-end px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td class="px-4">
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ asset($post->image) }}" class="rounded-3 object-fit-cover" width="50" height="50" onerror="this.src='https://placehold.co/50x50?text=Blog'">
                                <div>
                                    <p class="fw-bold mb-0 small">{{ $post->title }}</p>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-light text-dark border rounded-pill px-3">{{ $post->category ?? 'General' }}</span></td>
                        <td><code class="small">{{ $post->slug }}</code></td>
                        <td><span class="small">{{ $post->created_at->format('M d, Y') }}</span></td>
                        <td class="text-end px-4">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                    <li><a class="dropdown-item py-2" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                    <li><a class="dropdown-item py-2 text-danger" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">No blog posts found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($posts->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $posts->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
