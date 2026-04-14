<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title }} - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .card { backdrop-filter: blur(10px); background: rgba(255,255,255,0.95); }
        .content { line-height: 1.8; font-size: 1.1rem; }
        img.main-image { max-height: 400px; object-fit: cover; }
    </style>
</head>
<body class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="mb-4">
                    <a href="{{ route('blogs.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-arrow-left me-2"></i>Back to Blogs
                    </a>
                </div>

                <div class="card shadow-lg">
                    <h1 class="card-title display-4 fw-bold mb-4">{{ $blog->title }}</h1>
                    @if($blog->image)
                        <img src="{{ Storage::url($blog->image) }}" class="w-100 h-auto img-fluid" alt="{{ $blog->title }}">
                    @else
                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center text-white" >
                            <i class="bi bi-image fs-1 opacity-75"></i>
                        </div>
                    @endif
                    
                    <div class="card-body">
                        
                        
                        <div class="mb-4">
                            <small class="text-muted">
                                By {{ $blog->author }} | 
                                
                                <i class="bi bi-calendar-event me-1"></i>Created: 
                                {{ $blog->created_at->format('M d, Y h:i A') }}
                                
@if($blog->created_at->ne($blog->updated_at))
                                | 
                                <i class="bi bi-pencil-square me-1"></i>Edited: 
                                {{ $blog->updated_at->format('M d, Y h:i A') }}
                                @endif
                                
                                
                                @if($blog->status === 'published')
                                    <span class="badge bg-success ms-2">Published</span>
                                @else
                                    <span class="badge bg-secondary ms-2">Draft</span>
                                @endif
                            </small>
                        </div>

                        <div class="content">
                            {!! $blog->content !!}
                        </div>
                    </div>
                </div>

@if($isOwner)
                <div class="card mt-4 p-4 text-center">
                    <div class="btn-group" role="group">
                        <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form method="POST" action="{{ route('blogs.destroy', $blog) }}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-lg">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <a href="{{ route('logout') }}" class="btn btn-outline-light btn-lg rounded-circle" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>