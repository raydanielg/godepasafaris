@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Create New Blog</h1>
            <p class="text-muted small mb-0">Share your latest adventures and news with your audience</p>
        </div>
        <a href="{{ route('admin.posts') }}" class="btn btn-light border rounded-pill px-4 fw-bold shadow-sm">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Post Title</label>
                        <input type="text" name="title" class="form-control form-control-lg border-0 bg-light rounded-3" placeholder="Enter post title" required value="{{ old('title') }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Short Summary</label>
                        <textarea name="summary" class="form-control border-0 bg-light rounded-3" rows="3" placeholder="Enter a brief summary" required>{{ old('summary') }}</textarea>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-bold text-muted text-uppercase">Main Content</label>
                        <textarea name="content" id="blog-editor" class="form-control border-0 bg-light rounded-3" rows="15" placeholder="Write your blog content here..." required>{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-4">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Category</label>
                        <select name="category" class="form-select border-0 bg-light rounded-3" required>
                            <option value="" disabled selected>Select category</option>
                            <option value="Safari" {{ old('category') == 'Safari' ? 'selected' : '' }}>Safari</option>
                            <option value="Kilimanjaro" {{ old('category') == 'Kilimanjaro' ? 'selected' : '' }}>Kilimanjaro</option>
                            <option value="Destinations" {{ old('category') == 'Destinations' ? 'selected' : '' }}>Destinations</option>
                            <option value="Tips & Advice" {{ old('category') == 'Tips & Advice' ? 'selected' : '' }}>Tips & Advice</option>
                            <option value="News" {{ old('category') == 'News' ? 'selected' : '' }}>News</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Featured Image</label>
                        <div class="image-upload-wrapper border-2 border-dashed rounded-3 p-3 text-center bg-light" style="border-color: #dee2e6;">
                            <input type="file" name="image" class="form-control d-none" id="blogImage" accept="image/*">
                            <label for="blogImage" class="mb-0 cursor-pointer">
                                <div id="imagePreview" class="mb-2">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2"></i>
                                    <p class="small text-muted mb-0">Click to upload featured image</p>
                                </div>
                                <img id="previewImg" src="#" alt="Preview" class="img-fluid rounded-3 d-none">
                            </label>
                        </div>
                        <small class="text-muted smaller">Max size: 2MB. Recommended: 1200x600px</small>
                    </div>

                    <button type="submit" class="btn btn-earth w-100 py-3 rounded-pill fw-bold text-white shadow-sm" style="background-color: #8b4513;">
                        <i class="fas fa-paper-plane me-2"></i>Publish Blog Post
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }
        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    this._initRequest();
                    this._initListeners(resolve, reject, file);
                    this._sendRequest(file);
                }));
        }
        abort() {
            if (this.xhr) {
                this.xhr.abort();
            }
        }
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route("admin.posts.image.upload") }}', true);
            xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
            xhr.responseType = 'json';
        }
        _initListeners(resolve, reject, file) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${file.name}.`;
            xhr.addEventListener('error', () => reject(genericErrorText));
            xhr.addEventListener('abort', () => reject());
            xhr.addEventListener('load', () => {
                const response = xhr.response;
                if (!response || response.error) {
                    return reject(response && response.error ? response.error.message : genericErrorText);
                }
                resolve({
                    default: response.location
                });
            });
            if (xhr.upload) {
                xhr.upload.addEventListener('progress', evt => {
                    if (evt.lengthComputable) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                });
            }
        }
        _sendRequest(file) {
            const data = new FormData();
            data.append('file', file);
            this.xhr.send(data);
        }
    }

    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader);
        };
    }

    ClassicEditor
        .create(document.querySelector('#blog-editor'), {
            extraPlugins: [MyCustomUploadAdapterPlugin],
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'alignment', '|',
                    'outdent', 'indent', '|',
                    'link', 'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                    'undo', redo', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'horizontalLine', 'specialCharacters', 'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            image: {
                toolbar: [
                    'imageStyle:inline', 'imageStyle:block', 'imageStyle:side', '|',
                    'toggleImageCaption', 'imageTextAlternative'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn', 'tableRow', 'mergeTableCells', 'tableCellProperties', 'tableProperties'
                ]
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
                ]
            }
        })
        .then(editor => {
            console.log('Editor was initialized', editor);
        })
        .catch(error => {
            console.error(error);
        });

    // Image Preview for featured image
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
<style>
    .ck-editor__editable {
        min-height: 400px;
        background-color: #fdfaf5 !important;
        font-family: 'Nunito', sans-serif;
        font-size: 1.1rem;
        line-height: 1.8;
        padding: 2rem !important;
    }
    .ck-toolbar {
        border-radius: 15px 15px 0 0 !important;
        border: none !important;
        background-color: #f8f9fa !important;
        padding: 10px !important;
    }
    .ck-content {
        border-radius: 0 0 15px 15px !important;
        border: 1px solid #eee !important;
    }
</style>
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
