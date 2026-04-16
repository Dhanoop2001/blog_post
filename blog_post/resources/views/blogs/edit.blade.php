<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .card { backdrop-filter: blur(10px); background: rgba(255,255,255,0.9); }
        .tox-tinymce { border-radius: 0.375rem; }
    </style>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="card p-5 shadow-lg" style="max-width: 900px; width: 100%;">
        <div class="text-center mb-4">
            <h1 class="display-4 fw-bold text-primary mb-3">Edit Blog Post</h1>
            <p class="lead text-muted">Hello, {{ Auth::user()->name }}!</p>
            <small class="text-muted d-block mb-3">
                Created: {{ $blog->created_at->format('M d, Y H:i') }} | 
                Updated: {{ $blog->updated_at->format('M d, Y H:i') }}
            </small>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $blog->title) }}" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                @if($blog->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($blog->image) }}" alt="Current image" class="img-thumbnail" style="max-width: 200px;">
                        <div class="form-text">Upload new image to replace.</div>
                    </div>
                @endif
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <div class="input-group">
                    <span class="input-group-text">/blog/</span>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $blog->slug) }}">
                    <button class="btn btn-outline-secondary" type="button" id="generateSlug">Generate</button>
                </div>
                <div class="form-text">Leave empty for auto-generate from title, or enter custom.</div>
                @error('slug') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author', $blog->author ?? '') }}" placeholder="Enter author name" required>
                @error('author')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content (HTML Editor)</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="15">{{ old('content', $blog->content) }}</textarea>
                <div class="form-text">Enter HTML code for rich content with headings, links, etc.</div>
                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="draft" value="draft" {{ old('status', $blog->status) == 'draft' ? 'checked' : '' }}>
                    <label class="form-check-label" for="draft">Draft</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="published" value="published" {{ old('status', $blog->status) == 'published' ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">Published</label>
                </div>
                @error('status') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-list-ul me-2"></i>View Blogs
                </a>
                {{-- <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-lg rounded-circle position-fixed top-0 end-0 p-3" style="margin: 1rem;" onclick="event.preventDefault(); Swal.fire({title: 'Are you sure?', text: 'You will be logged out!', icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#3085d6'}).then((result) => { if (result.isConfirmed) { document.getElementById('logout-form').submit(); } })" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </a> --}}
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-save"></i> Update Blog Post
                </button>
            </div>
        </form>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        <script>
            // Slug generation
            document.getElementById('title').addEventListener('input', function() {
                document.getElementById('generateSlug').click();
            });
            document.getElementById('generateSlug').addEventListener('click', function() {
                const title = document.getElementById('title').value;
                if (title) {
                    fetch('{{ route('blog.slug') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({title: title})
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('slug').value = data.slug;
                    });
                }
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
</html>

