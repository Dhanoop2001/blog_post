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
        body { background: whitesmoke; min-height: 100vh; }
        .card { backdrop-filter: blur(10px); background: rgba(255,255,255,0.95); transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); }
        .excerpt { display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; }
        .section-title { color: black; border-bottom: 2px solid rgba(255,255,255,0.3); padding-bottom: 1rem; margin-bottom: 2rem; }
        .list-card { backdrop-filter: blur(20px); background: rgba(255,255,255,0.15); max-width: 1400px; width: 100%; max-height: 90vh; overflow-y: auto; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 p-3 p-md-5">
    <div class="card list-card shadow-xl rounded-4">
        <div class="col-lg-10 mx-auto p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="display-4 fw-bold text-black mb-0">
                    <i class="bi bi-rss me-3"></i>My Blogs
                </h1>
                <a href="{{ route('blog') }}" class="btn btn-primary btn-lg me-2">
                    <i class="bi bi-plus-circle me-2"></i>New Post
                </a>
<a href="{{ route('blogs.all') }}" class="btn btn-outline-dark text-black  btn-lg">
                    <i class="bi bi-globe me-2"></i>All Users Blogs
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Filter Buttons --}}
            <div class="btn-group w-100 mb-5 justify-content-center" role="group">
                <button type="button" class="btn btn-outline-dark text-black  btn-lg filter-btn section-active" data-target="all-section">
                    <i class="bi bi-list-ul me-2"></i>All <span class="badge bg-light text-dark ms-1" id="all-count">{{ $allBlogs->total() }}</span>
                </button>
                <button type="button" class="btn btn-outline-dark text-black  btn-lg filter-btn" data-target="published-section">
                    <i class="bi bi-check-circle me-2 text-success"></i>Published <span class="badge bg-success ms-1" id="published-count">{{ $publishedBlogs->total() }}</span>
                </button>
                <button type="button" class="btn btn-outline-dark text-black  btn-lg filter-btn" data-target="draft-section">
                    <i class="bi bi-file-earmark-text me-2 text-secondary"></i>Drafts <span class="badge bg-secondary ms-1" id="draft-count">{{ $draftedBlogs->total() }}</span>
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
                               
                                <div class="card h-100 shadow-lg">
                                     <div class="card-body d-flex flex-column">
                                        <h5 class="card-title fw-bold">{{ $blog->title }}</h5>
                                    @if($blog->image)
                                        <img src="{{ Storage::url($blog->image) }}" class="card-img-top w-100 h-100 object-fit-cover" alt="{{ $blog->title }}" style="height: 200px;">
                                    @else
                                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center text-white" style="height: 200px;">
                                            <i class="bi bi-image fs-1 opacity-75"></i>
                                        </div>
                                    @endif
                                    
                                        <p class="card-text text-muted excerpt">{{ Str::limit($blog->content, 150) }}</p>
                                        <div class="mt-auto">
                                            <small class="text-muted mb-2 d-block">
                                                By {{ $blog->author }}<br>
                                                <i class="bi bi-calendar-event me-1"></i>{{ $blog->created_at->format('M d, Y') }}<br>
                                                @if($blog->created_at->ne($blog->updated_at))
                                                <i class="bi bi-pencil-square me-1"></i>{{ $blog->updated_at->format('M d, Y') }}
                                                @endif
                                                @if($blog->status === 'published')
                                                    <span class="badge bg-success">Published</span>
                                                @else
                                                    <span class="badge bg-secondary">Draft</span>
                                                @endif
                                            </small>
                                            @if($blog->user_id === auth()->id())
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('blogs.show', $blog) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                                <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <form method="POST" action="{{ route('blogs.destroy', $blog) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $allBlogs->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-journal-text fs-1 text-white-50 mb-4"></i>
                        <h3 class="text-white-50 mb-3">No blogs yet</h3>
                        <p class="text-white-50 mb-4">Create your first blog post to get started!</p>
                        <a href="{{ route('blog') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-plus-circle me-2"></i>Create First Post
                        </a>
                    </div>
                @endif
            </div>

            {{-- Section 2: Published Blogs --}}
            <div id="published-section" class="blog-section mb-5 d-none">
                <h2 class="section-title">
                    <i class="bi bi-check-circle me-2 text-success"></i>Published Blogs ({{ $publishedBlogs->total() }})
                </h2>
                @if($publishedBlogs->count() > 0)
                    <div class="row g-4">
                        @foreach($publishedBlogs as $blog)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 shadow-lg">
                                    <h5 class="card-title fw-bold">{{ $blog->title }}</h5>
                                    @if($blog->image)
                                        <img src="{{ Storage::url($blog->image) }}" class="card-img-top w-100 h-100 object-fit-cover" alt="{{ $blog->title }}" style="height: 200px;">
                                    @else
                                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center text-white" style="height: 200px;">
                                            <i class="bi bi-image fs-1 opacity-75"></i>
                                        </div>
                                    @endif
                                    <div class="card-body d-flex flex-column">
                                        
                                        <p class="card-text text-muted excerpt">{{ Str::limit($blog->content, 150) }}</p>
                                        <div class="mt-auto">
                                            <small class="text-muted mb-2 d-block">
                                                By {{ $blog->author }}<br>
                                                <i class="bi bi-calendar-event me-1"></i>{{ $blog->created_at->format('M d, Y') }}<br>
                                                @if($blog->created_at->ne($blog->updated_at))
                                                <i class="bi bi-pencil-square me-1"></i>{{ $blog->updated_at->format('M d, Y') }}
                                                @endif
                                                <span class="badge bg-success">Published</span>
                                            </small>
                                            @if($blog->user_id === auth()->id())
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('blogs.show', $blog) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                                <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <form method="POST" action="{{ route('blogs.destroy', $blog) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $publishedBlogs->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-5 bg-white bg-opacity-10 rounded p-4">
                        <i class="bi bi-star fs-1 text-warning mb-4"></i>
                        <h4 class="text-white-50 mb-3">No published blogs</h4>
                        <p class="text-white-50 mb-4">Publish a draft to see it here!</p>
                    </div>
                @endif
            </div>

            {{-- Section 3: Drafted Blogs --}}
            <div id="draft-section" class="blog-section mb-5 d-none">
                <h2 class="section-title">
                    <i class="bi bi-file-earmark-text me-2 text-secondary"></i>Draft Blogs ({{ $draftedBlogs->total() }})
                </h2>
                @if($draftedBlogs->count() > 0)
                    <div class="row g-4">
                        @foreach($draftedBlogs as $blog)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 shadow-lg">
                                     <h5 class="card-title fw-bold">{{ $blog->title }}</h5>
                                    @if($blog->image)
                                        <img src="{{ Storage::url($blog->image) }}" class="card-img-top w-100 h-100 object-fit-cover" alt="{{ $blog->title }}" style="height: 200px;">
                                    @else
                                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center text-white" style="height: 200px;">
                                            <i class="bi bi-image fs-1 opacity-75"></i>
                                        </div>
                                    @endif
                        <div class="card-body d-flex flex-column">
                                        <p class="card-text text-muted excerpt">{{ Str::limit($blog->content, 150) }}</p>
                                        <div class="mt-auto">
                                            <small class="text-muted mb-2 d-block">
                                                By {{ $blog->author }}<br>
                                                <i class="bi bi-calendar-event me-1"></i>{{ $blog->created_at->format('M d, Y') }}<br>
                                                @if($blog->created_at->ne($blog->updated_at))
                                                <i class="bi bi-pencil-square me-1"></i>{{ $blog->updated_at->format('M d, Y') }}
                                                @endif
                                                <span class="badge bg-secondary">Draft</span>
                                            </small>
                                            @if($blog->user_id === auth()->id())
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('blogs.show', $blog) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                                <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <form method="POST" action="{{ route('blogs.destroy', $blog) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $draftedBlogs->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-5 bg-white bg-opacity-10 rounded p-4">
                        <i class="bi bi-pencil-square fs-1 text-muted mb-4"></i>
                        <h4 class="text-white-50 mb-3">No draft blogs</h4>
                        <p class="text-white-50 mb-4">Your drafts will appear here.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
            <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-lg rounded-circle" onclick="event.preventDefault(); Swal.fire({title: 'Are you sure?', text: 'You will be logged out!', icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#3085d6'}).then((result) => { if (result.isConfirmed) { document.getElementById('logout-form').submit(); } })" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </div>

    <script>
        // Blog filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const sections = document.querySelectorAll('.blog-section');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const target = this.getAttribute('data-target');
                    
                    // Remove active from all buttons and hide all sections
                    filterBtns.forEach(b => b.classList.remove('btn-primary', 'section-active'));
                    filterBtns.forEach(b => b.classList.add('btn-outline-light'));
                    sections.forEach(s => s.classList.add('d-none'));
                    
                    // Show target section and activate button
                    document.getElementById(target).classList.remove('d-none');
                    this.classList.add('btn-primary', 'section-active');
                    this.classList.remove('btn-outline-light');
                    
                    // Smooth scroll to top of section
                    document.getElementById(target).scrollIntoView({ behavior: 'smooth' });
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
