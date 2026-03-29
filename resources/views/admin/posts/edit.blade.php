@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Edit Blog Post</h1>
            <p class="text-muted small mb-0">Update your article: <strong>{{ $post->title }}</strong></p>
        </div>
        <a href="{{ route('admin.posts') }}" class="btn btn-light border rounded-pill px-4 fw-bold shadow-sm">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Post Title</label>
                        <input type="text" name="title" class="form-control form-control-lg border-0 bg-light rounded-3" placeholder="Enter post title" required value="{{ old('title', $post->title) }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Short Summary</label>
                        <textarea name="summary" class="form-control border-0 bg-light rounded-3" rows="3" placeholder="Enter a brief summary" required>{{ old('summary', $post->summary) }}</textarea>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-bold text-muted text-uppercase">Main Content</label>
                        <textarea name="content" id="blog-editor" class="form-control border-0 bg-light rounded-3" rows="15" placeholder="Write your blog content here..." required>{{ old('content', $post->content) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Category</label>
                        <select name="category" class="form-select border-0 bg-light rounded-3" required>
                            <option value="" disabled>Select category</option>
                            <option value="Safari" {{ old('category', $post->category) == 'Safari' ? 'selected' : '' }}>Safari</option>
                            <option value="Kilimanjaro" {{ old('category', $post->category) == 'Kilimanjaro' ? 'selected' : '' }}>Kilimanjaro</option>
                            <option value="Destinations" {{ old('category', $post->category) == 'Destinations' ? 'selected' : '' }}>Destinations</option>
                            <option value="Tips & Advice" {{ old('category', $post->category) == 'Tips & Advice' ? 'selected' : '' }}>Tips & Advice</option>
                            <option value="News" {{ old('category', $post->category) == 'News' ? 'selected' : '' }}>News</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Featured Image</label>
                        <div class="image-upload-wrapper border-2 border-dashed rounded-3 p-3 text-center bg-light mb-2" style="border-color: #dee2e6;">
                            <input type="file" name="image" class="form-control d-none" id="blogImage" accept="image/*">
                            <label for="blogImage" class="mb-0 cursor-pointer">
                                <div id="imagePreview" class="{{ $post->image ? 'd-none' : '' }}">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2"></i>
                                    <p class="small text-muted mb-0">Click to change image</p>
                                </div>
                                <img id="previewImg" src="{{ $post->image ? asset($post->image) : '#' }}" alt="Preview" class="img-fluid rounded-3 {{ $post->image ? '' : 'd-none' }}">
                            </label>
                        </div>
                        <small class="text-muted smaller">Leave empty to keep current image. Max: 2MB</small>
                    </div>

                    <button type="submit" class="btn btn-earth w-100 py-3 rounded-pill fw-bold text-white shadow-sm" style="background-color: #8b4513;">
                        <i class="fas fa-save me-2"></i>Update Blog Post
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#blog-editor',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate mentions tableofcontents footnotes meridians autocorrect autosave',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        images_upload_url: '{{ route("admin.posts.image.upload") }}',
        automatic_uploads: true,
        images_reuse_filename: true,
        paste_data_images: true
    });

    document.getElementById('blogImage').addEventListener('change', function(e) {
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
@endpush

<style>
    .cursor-pointer { cursor: pointer; }
    .form-control:focus, .form-select:focus {
        background-color: #fff !important;
        border: 1px solid #deb887 !important;
        box-shadow: 0 0 0 0.2rem rgba(222, 184, 135, 0.25) !important;
    }
    .btn-earth:hover {
        background-color: #3E2723 !important;
        opacity: 0.9;
    }
</style>
@endsection
