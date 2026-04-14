<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blogs - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .card { backdrop-filter: blur(10px); background: rgba(255,255,255,0.95); transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); }
        .excerpt { display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; }
        .section-title { color: rgba(255,255,255,0.95); border-bottom: 2px solid rgba(255,255,255,0.3); padding-bottom: 1rem; margin-bottom: 2rem; }
    </style>
</head>
<body class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="display-4 fw-bold text-white mb-0">
                        <i class="bi bi-rss me-3"></i>All Published Blogs
                    </h1>
                    <div>
                        <a href="{{ route('blogs.index') }}" class="btn btn-outline-light btn-lg me-2">
                            <i class="bi bi-person-lines-fill me-2"></i>My Blogs
                        </a>
                        @auth
                            <a href="{{ route('blog') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-plus-circle me-2"></i>New Post
                            </a>
                        @endauth
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
                                <div class="card h-100 shadow-lg">
                                   
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title fw-bold">{{ $blog->title }}</h5>
                                         @if($blog->image)
                                        <img src="{{ Storage::url($blog->image) }}" class="card-img-top object-fit-cover" alt="{{ $blog->title }}" style="height: 200px;">
                                    @else
                                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center text-white" style="height: 200px;">
                                            <i class="bi bi-image fs-1 opacity-75"></i>
                                        </div>
                                    @endif
                                        <p class="card-text text-muted excerpt">{{ Str::limit(strip_tags($blog->content), 150) }}</p>
                                        <div class="mt-auto">
                                            <small class="text-muted mb-2 d-block">
                                                By {{ $blog->author }}<br>
                                                <i class="bi bi-calendar-event me-1"></i>{{ $blog->created_at->format('M d, Y') }}<br>
                                                @if($blog->created_at->ne($blog->updated_at))
                                                <i class="bi bi-pencil-square me-1"></i>{{ $blog->updated_at->format('M d, Y') }}
                                                @endif
                                                <span class="badge bg-success">Published</span>
                                            </small>
                                            <a href="{{ route('blogs.show', $blog) }}" class="btn btn-outline-primary w-100" target="_blank">
                                                <i class="bi bi-eye me-2"></i>Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $publishedBlogs->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-newspaper fs-1 text-white-50 mb-4"></i>
                        <h3 class="text-white-50 mb-3">No published blogs yet</h3>
                        <p class="text-white-50 mb-4">No blogs published by any users yet!</p>
                        @auth
                            <a href="{{ route('blog') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-plus-circle me-2"></i>Be the First to Publish
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-person-plus me-2"></i>Create Account & Publish
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
