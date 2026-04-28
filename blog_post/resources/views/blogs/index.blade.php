<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs - {{ config('app.name', 'Laravel') }}</title>
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
        .logout-btn {
            position: fixed;
            top: 16px;
            right: 16px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #ffffff;
            border: 1px solid #e5e5e5;
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.2s;
            z-index: 1055;
            text-decoration: none;
        }
        .logout-btn:hover { border-color: #dc2626; background: #fef2f2; }
        .alert {
            border-radius: 10px;
            border: none;
            font-size: 14px;
        }
        .alert-success { background: #f0fdf4; color: #166534; }
        .filter-group {
            display: flex;
            gap: 8px;
            margin-bottom: 32px;
            flex-wrap: wrap;
        }
        .filter-btn {
            padding: 10px 20px;
            background: #ffffff;
            color: #737373;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .filter-btn:hover { border-color: #0a0a0a; color: #0a0a0a; }
        .filter-btn.active {
            background: #0a0a0a;
            color: #ffffff;
            border-color: #0a0a0a;
        }
        .filter-btn .badge-count {
            background: #f5f5f5;
            color: #737373;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .filter-btn.active .badge-count {
            background: rgba(255,255,255,0.2);
            color: #ffffff;
        }
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
            margin-bottom: 12px;
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
        .badge-status-draft {
            background: #e5e5e5;
            color: #737373;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
        .card-actions {
            display: flex;
            gap: 6px;
        }
        .card-actions .btn {
            flex: 1;
            padding: 8px 12px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .btn-sm-outline {
            background: #ffffff;
            color: #0a0a0a;
            border: 1px solid #e5e5e5;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-sm-outline:hover { border-color: #0a0a0a; color: #0a0a0a; }
        .btn-sm-outline-danger {
            background: #ffffff;
            color: #dc2626;
            border: 1px solid #fecaca;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-sm-outline-danger:hover { background: #fef2f2; }
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
        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #0a0a0a;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f0f0f0;
        }
    </style>
</head>
<body>
    <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); Swal.fire({title: 'Are you sure?', text: 'You will be logged out!', icon: 'warning', showCancelButton: true, confirmButtonColor: '#dc2626', cancelButtonColor: '#0a0a0a'}).then((result) => { if (result.isConfirmed) { document.getElementById('logout-form').submit(); } })" title="Logout">
        <i class="bi bi-box-arrow-right"></i>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

    <div class="container-custom">
        <div class="page-header">
            <h1 class="page-title">
                <i class="bi bi-rss me-2"></i>My Blogs
            </h1>
            <div class="d-flex gap-2">
                <a href="{{ route('blog') }}" class="btn-primary-custom">
                    <i class="bi bi-plus-circle"></i> New Post
                </a>
                <a href="{{ route('blogs.all') }}" class="btn-outline-custom">
                    <i class="bi bi-globe"></i> All Users Blogs
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="filter-group">
            <button type="button" class="filter-btn active" data-target="all-section">
                <i class="bi bi-list-ul"></i> All <span class="badge-count" id="all-count">{{ $allBlogs->total() }}</span>
            </button>
            <button type="button" class="filter-btn" data-target="published-section">
                <i class="bi bi-check-circle"></i> Published <span class="badge-count" id="published-count">{{ $publishedBlogs->total() }}</span>
            </button>
            <button type="button" class="filter-btn" data-target="draft-section">
                <i class="bi bi-file-earmark-text"></i> Drafts <span class="badge-count" id="draft-count">{{ $draftedBlogs->total() }}</span>
            </button>
        </div>

        {{-- Section 1: All Blogs --}}
        <div id="all-section" class="blog-section mb-5">
            <h2 class="section-title">
                <i class="bi bi-list-ul me-2"></i>All Blogs ({{ $allBlogs->total() }})
            </h2>
            @if($allBlogs->count() > 0)
                <div class="row g-4">
                    @foreach($allBlogs as $blog)
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
                                    <p class="blog-card-excerpt">{{ Str::limit($blog->content, 150) }}</p>
                                    <div class="blog-card-meta">
                                        By {{ $blog->author }}<br>
                                        <i class="bi bi-calendar-event"></i> {{ $blog->created_at->format('M d, Y') }}
                                        @if($blog->created_at->ne($blog->updated_at))
                                            <br><i class="bi bi-pencil-square"></i> {{ $blog->updated_at->format('M d, Y') }}
                                        @endif
                                        <br>
                                        @if($blog->status === 'published')
                                            <span class="badge-status-published">Published</span>
                                        @else
                                            <span class="badge-status-draft">Draft</span>
                                        @endif
                                    </div>
                                    @if($blog->user_id === auth()->id())
                                    <div class="card-actions">
                                        <a href="{{ route('blogs.show', $blog) }}" class="btn-sm-outline">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                        <a href="{{ route('blogs.edit', $blog) }}" class="btn-sm-outline">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('blogs.destroy', $blog) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm-outline-danger w-100">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $allBlogs->appends(request()->query())->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-journal-text"></i>
                    <h3>No blogs yet</h3>
                    <p>Create your first blog post to get started!</p>
                    <a href="{{ route('blog') }}" class="btn-primary-custom">
                        <i class="bi bi-plus-circle me-2"></i> Create First Post
                    </a>
                </div>
            @endif
        </div>

        {{-- Section 2: Published Blogs --}}
        <div id="published-section" class="blog-section mb-5 d-none">
            <h2 class="section-title">
                <i class="bi bi-check-circle me-2"></i>Published Blogs ({{ $publishedBlogs->total() }})
            </h2>
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
                                    <p class="blog-card-excerpt">{{ Str::limit($blog->content, 150) }}</p>
                                    <div class="blog-card-meta">
                                        By {{ $blog->author }}<br>
                                        <i class="bi bi-calendar-event"></i> {{ $blog->created_at->format('M d, Y') }}
                                        @if($blog->created_at->ne($blog->updated_at))
                                            <br><i class="bi bi-pencil-square"></i> {{ $blog->updated_at->format('M d, Y') }}
                                        @endif
                                        <br><span class="badge-status-published">Published</span>
                                    </div>
                                    @if($blog->user_id === auth()->id())
                                    <div class="card-actions">
                                        <a href="{{ route('blogs.show', $blog) }}" class="btn-sm-outline">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                        <a href="{{ route('blogs.edit', $blog) }}" class="btn-sm-outline">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('blogs.destroy', $blog) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm-outline-danger w-100">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $publishedBlogs->appends(request()->query())->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-star"></i>
                    <h3>No published blogs</h3>
                    <p>Publish a draft to see it here!</p>
                </div>
            @endif
        </div>

        {{-- Section 3: Drafted Blogs --}}
        <div id="draft-section" class="blog-section mb-5 d-none">
            <h2 class="section-title">
                <i class="bi bi-file-earmark-text me-2"></i>Draft Blogs ({{ $draftedBlogs->total() }})
            </h2>
            @if($draftedBlogs->count() > 0)
                <div class="row g-4">
                    @foreach($draftedBlogs as $blog)
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
                                    <p class="blog-card-excerpt">{{ Str::limit($blog->content, 150) }}</p>
                                    <div class="blog-card-meta">
                                        By {{ $blog->author }}<br>
                                        <i class="bi bi-calendar-event"></i> {{ $blog->created_at->format('M d, Y') }}
                                        @if($blog->created_at->ne($blog->updated_at))
                                            <br><i class="bi bi-pencil-square"></i> {{ $blog->updated_at->format('M d, Y') }}
                                        @endif
                                        <br><span class="badge-status-draft">Draft</span>
                                    </div>
                                    @if($blog->user_id === auth()->id())
                                    <div class="card-actions">
                                        <a href="{{ route('blogs.show', $blog) }}" class="btn-sm-outline">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                        <a href="{{ route('blogs.edit', $blog) }}" class="btn-sm-outline">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('blogs.destroy', $blog) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm-outline-danger w-100">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $draftedBlogs->appends(request()->query())->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="bi bi-pencil-square"></i>
                    <h3>No draft blogs</h3>
                    <p>Your drafts will appear here.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const sections = document.querySelectorAll('.blog-section');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const target = this.getAttribute('data-target');
                    
                    filterBtns.forEach(b => b.classList.remove('active'));
                    sections.forEach(s => s.classList.add('d-none'));
                    
                    document.getElementById(target).classList.remove('d-none');
                    this.classList.add('active');
                    
                    document.getElementById(target).scrollIntoView({ behavior: 'smooth' });
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

