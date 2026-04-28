<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Blogs - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #fafafa;
            color: #0a0a0a;
            min-height: 100vh;
            padding: 40px 16px;
        }
        .container-custom {
            max-width: 1400px;
            margin: 0 auto;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }
        .page-title {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #0a0a0a;
        }
        .btn-primary-custom {
            padding: 12px 20px;
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
            padding: 12px 20px;
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
        .alert {
            border-radius: 10px;
            border: none;
            font-size: 14px;
        }
        .alert-success { background: #f0fdf4; color: #166534; }
        .blog-card {
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.2s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.08);
        }
        .blog-card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #f0f0f0;
        }
        .blog-card-image-placeholder {
            width: 100%;
            height: 200px;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a3a3a3;
            border-bottom: 1px solid #f0f0f0;
        }
        .blog-card-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .blog-card-title {
            font-size: 17px;
            font-weight: 700;
            color: #0a0a0a;
            margin-bottom: 10px;
            line-height: 1.3;
        }
        .blog-card-excerpt {
            font-size: 14px;
            color: #737373;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 16px;
            flex: 1;
        }
        .blog-card-meta {
            font-size: 12px;
            color: #a3a3a3;
            margin-bottom: 16px;
            line-height: 1.6;
        }
        .blog-card-meta i { margin-right: 4px; }
        .badge-status-published {
            background: #0a0a0a;
            color: #ffffff;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
        .btn-read {
            width: 100%;
            padding: 10px;
            background: #ffffff;
            color: #0a0a0a;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-read:hover { border-color: #0a0a0a; color: #0a0a0a; }
        .empty-state {
            text-align: center;
            padding: 64px 24px;
        }
        .empty-state i {
            font-size: 48px;
            color: #d4d4d4;
            margin-bottom: 16px;
        }
        .empty-state h3 {
            font-size: 20px;
            font-weight: 600;
            color: #a3a3a3;
            margin-bottom: 8px;
        }
        .empty-state p {
            font-size: 14px;
            color: #a3a3a3;
            margin-bottom: 24px;
        }
        .pagination .page-link {
            color: #0a0a0a;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            margin: 0 4px;
            font-size: 14px;
            font-weight: 500;
        }
        .pagination .page-link:hover {
            background: #f5f5f5;
            border-color: #d4d4d4;
        }
        .pagination .page-item.active .page-link {
            background: #0a0a0a;
            border-color: #0a0a0a;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container-custom">
        <div class="page-header">
            <h1 class="page-title">
                <i class="bi bi-rss me-2"></i>Public Blogs
            </h1>
            <div class="d-flex gap-2">
                @auth
                    <a href="{{ route('blogs.index') }}" class="btn-outline-custom">
                        <i class="bi bi-person-lines-fill"></i> My Blogs
                    </a>
                @endauth
                <a href="{{ route('register') }}" class="btn-primary-custom">
                    <i class="bi bi-person-plus"></i> Sign Up
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($publishedBlogs->count() > 0)
            <div class="row g-4">
                @foreach($publishedBlogs as $blog)
                    <div class="col-md-6 col-lg-4">
                        <div class="blog-card">
                            @if($blog->image)
                                <img src="{{ Storage::url($blog->image) }}" class="blog-card-image" alt="{{ $blog->title }}">
                            @else
                                <div class="blog-card-image-placeholder">
                                    <i class="bi bi-image fs-1"></i>
                                </div>
                            @endif
                            <div class="blog-card-body">
                                <h5 class="blog-card-title">{{ $blog->title }}</h5>
                                <p class="blog-card-excerpt">{{ Str::limit(strip_tags($blog->content), 150) }}</p>
                                <div class="blog-card-meta">
                                    By {{ $blog->author }}<br>
                                    <i class="bi bi-calendar-event"></i> {{ $blog->created_at->format('M d, Y') }}
                                    @if($blog->created_at->ne($blog->updated_at))
                                        <br><i class="bi bi-pencil-square"></i> {{ $blog->updated_at->format('M d, Y') }}
                                    @endif
                                    <br><span class="badge-status-published">Published</span>
                                </div>
                                <a href="{{ route('blogs.show', $blog) }}" class="btn-read">
                                    <i class="bi bi-eye"></i> Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $publishedBlogs->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="bi bi-newspaper"></i>
                <h3>No published blogs yet</h3>
                <p>Be the first to publish a blog post!</p>
                <a href="{{ route('register') }}" class="btn-primary-custom">
                    <i class="bi bi-plus-circle me-2"></i> Create Account & Publish
                </a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

