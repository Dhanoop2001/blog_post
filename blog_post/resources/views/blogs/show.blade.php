<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title }} - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #fafafa;
            color: #0a0a0a;
            min-height: 100vh;
            padding: 48px 16px;
        }
        .container-custom {
            max-width: 900px;
            margin: 0 auto;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #ffffff;
            color: #0a0a0a;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            margin-bottom: 24px;
        }
        .btn-back:hover { border-color: #0a0a0a; color: #0a0a0a; }
        .blog-card {
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.05);
        }
        .blog-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-bottom: 1px solid #e5e5e5;
        }
        .blog-image-placeholder {
            width: 100%;
            height: 300px;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a3a3a3;
            border-bottom: 1px solid #e5e5e5;
        }
        .blog-body {
            padding: 40px;
        }
        .blog-title {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.02em;
            line-height: 1.2;
            margin-bottom: 16px;
            color: #0a0a0a;
        }
        .blog-meta {
            font-size: 14px;
            color: #737373;
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 1px solid #f0f0f0;
        }
        .blog-meta i { margin-right: 4px; }
        .badge-published {
            background: #0a0a0a;
            color: #ffffff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }
        .badge-draft {
            background: #d4d4d4;
            color: #525252;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }
        .blog-content {
            line-height: 1.8;
            font-size: 16px;
            color: #262626;
        }
        .blog-content p { margin-bottom: 1.2em; }
        .blog-content h2, .blog-content h3 { margin-top: 1.5em; margin-bottom: 0.8em; color: #0a0a0a; }
        .action-card {
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 16px;
            padding: 24px;
            margin-top: 24px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.05);
        }
        .btn-action {
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            text-decoration: none;
            border: none;
        }
        .btn-edit {
            background: #0a0a0a;
            color: #ffffff;
        }
        .btn-edit:hover { background: #262626; color: #ffffff; }
        .btn-delete {
            background: #ffffff;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        .btn-delete:hover { background: #fef2f2; }
    </style>
</head>
<body>
    <div class="container-custom">
        <a href="{{ route('blogs.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Back to Blogs
        </a>

        <div class="blog-card">
            @if($blog->image)
                <img src="{{ Storage::url($blog->image) }}" class="blog-image" alt="{{ $blog->title }}">
            @else
                <div class="blog-image-placeholder">
                    <i class="bi bi-image fs-1"></i>
                </div>
            @endif
            
            <div class="blog-body">
                <h1 class="blog-title">{{ $blog->title }}</h1>
                
                <div class="blog-meta">
                    By {{ $blog->author }} | 
                    <i class="bi bi-calendar-event"></i> Created: {{ $blog->created_at->format('M d, Y h:i A') }}
                    @if($blog->created_at->ne($blog->updated_at))
                        | <i class="bi bi-pencil-square"></i> Edited: {{ $blog->updated_at->format('M d, Y h:i A') }}
                    @endif
                    @if($blog->status === 'published')
                        <span class="badge-published">Published</span>
                    @else
                        <span class="badge-draft">Draft</span>
                    @endif
                </div>

                <div class="blog-content">
                    {!! nl2br($blog->content) !!}
                </div>
            </div>
        </div>

        @if($isOwner)
            <div class="action-card">
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('blogs.edit', $blog) }}" class="btn-action btn-edit">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form method="POST" action="{{ route('blogs.destroy', $blog) }}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-action btn-delete">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

