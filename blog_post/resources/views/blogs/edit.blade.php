<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #fafafa;
            color: #0a0a0a;
            min-height: 100vh;
            padding: 48px 16px;
        }
        .blog-card {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.05);
        }
        .blog-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .blog-header h1 {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: 8px;
        }
        .blog-header p {
            font-size: 15px;
            color: #737373;
        }
        .blog-meta {
            font-size: 13px;
            color: #a3a3a3;
            margin-top: 4px;
        }
        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #0a0a0a;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            color: #0a0a0a;
            transition: all 0.2s;
        }
        .form-control::placeholder { color: #a3a3a3; }
        .form-control:focus, .form-select:focus {
            border-color: #0a0a0a;
            box-shadow: 0 0 0 3px rgba(0,0,0,0.08);
        }
        .form-control.is-invalid { border-color: #ef4444; }
        .invalid-feedback { font-size: 13px; color: #dc2626; }
        .input-group-text {
            background: #f5f5f5;
            border: 1px solid #e5e5e5;
            color: #737373;
            font-size: 14px;
        }
        .btn-primary-custom {
            padding: 12px 24px;
            background: #0a0a0a;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            text-decoration: none;
        }
        .btn-primary-custom:hover { background: #262626; color: #ffffff; }
        .btn-outline-custom {
            padding: 12px 24px;
            background: #ffffff;
            color: #0a0a0a;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            text-decoration: none;
        }
        .btn-outline-custom:hover { border-color: #0a0a0a; color: #0a0a0a; }
        .form-text { font-size: 12px; color: #a3a3a3; }
        .form-check-input:checked { background-color: #0a0a0a; border-color: #0a0a0a; }
        .alert {
            border-radius: 10px;
            border: none;
            font-size: 14px;
        }
        .alert-success { background: #f0fdf4; color: #166534; }
        .img-thumbnail {
            border-radius: 10px;
            border: 1px solid #e5e5e5;
        }
    </style>
</head>
<body>
    <div class="blog-card">
        <div class="blog-header">
            <h1>Edit Blog Post</h1>
            <p>Hello, {{ Auth::user()->name }}!</p>
            <div class="blog-meta">
                Created: {{ $blog->created_at->format('M d, Y H:i') }} | Updated: {{ $blog->updated_at->format('M d, Y H:i') }}
            </div>
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

            <div class="mb-4">
                <label class="form-label">Status</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="draft" value="draft" {{ old('status', $blog->status) == 'draft' ? 'checked' : '' }}>
                        <label class="form-check-label" for="draft">Draft</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('status') is-invalid @enderror" type="radio" name="status" id="published" value="published" {{ old('status', $blog->status) == 'published' ? 'checked' : '' }}>
                        <label class="form-check-label" for="published">Published</label>
                    </div>
                </div>
                @error('status') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('blogs.index') }}" class="btn-outline-custom">
                    <i class="bi bi-list-ul"></i> View Blogs
                </a>
                <button type="submit" class="btn-primary-custom">
                    <i class="bi bi-save"></i> Update Blog Post
                </button>
            </div>
        </form>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        <script>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

