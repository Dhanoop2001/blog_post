<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display the blog creation form.
     */
    public function create()
    {
        return view('auth.blog');
    }

    /**
     * Store a new blog post.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'slug'    => 'nullable|string|max:255|unique:blog_posts,slug',
            'author'  => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'  => 'required|in:draft,published',
        ]);

        $data = $request->all();

        // WYSIWYG: Allow HTML content
        $data['slug']     = $request->slug ?: Str::slug($request->title);
        $data['user_id']  = Auth::id();
        $data['author_id'] = Auth::id();
        $data['author']   = $request->author;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store(
                'images/blogs',
                'public'
            );
        }

        BlogPost::create($data);

        return redirect()
            ->route('blog')
            ->with('success', 'Blog post created successfully!');
    }

    /**
     * Generate slug from title.
     */
    public function generateSlug(Request $request)
    {
        $slug = Str::slug($request->title);

        return response()->json([
            'slug' => $slug
        ]);
    }

    /**
     * Display authenticated user's blogs with filters.
     */
    public function index()
    {
        $allBlogs     = Auth::user()->blogPosts()->latest()->paginate(10);
        $publishedBlogs = Auth::user()
            ->blogPosts()
            ->published()
            ->latest()
            ->paginate(10);
        $draftedBlogs = Auth::user()
            ->blogPosts()
            ->draft()
            ->latest()
            ->paginate(10);

        return view('blogs.index', compact(
            'allBlogs',
            'publishedBlogs',
            'draftedBlogs'
        ));
    }

    /**
     * Display public published blogs.
     */
    /**
     * Display all published blogs (public or auth dashboard).
     */
    public function publicIndex()
    {
        $publishedBlogs = BlogPost::published()
            ->with('author')
            ->latest()
            ->paginate(12);

        if (request()->is('blogs/all')) {
            return view('all-blogs.index', compact('publishedBlogs'));
        }

        return view('public-blogs.index', compact('publishedBlogs'));
    }

    /**
     * Display edit form for blog post.
     */
    public function edit(BlogPost $blog)
    {
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update blog post.
     */
    public function update(Request $request, BlogPost $blog)
    {
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'title'   => 'required|string|max:255',
            'slug'    => 'nullable|string|max:255|unique:blog_posts,slug,' . $blog->id,
            'author'  => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'  => 'required|in:draft,published',
        ]);

        $data = $request->all();

        // WYSIWYG: Allow HTML content
        $data['slug']     = $request->slug ?: Str::slug($request->title);
        $data['author_id'] = Auth::id();
        $data['author']   = $request->author;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }

            $data['image'] = $request->file('image')->store(
                'images/blogs',
                'public'
            );
        }

        $blog->update($data);

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog post updated successfully!');
    }

    /**
     * Delete blog post.
     */
    public function destroy(BlogPost $blog)
    {
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog post deleted successfully!');
    }

    /**
     * Display specific blog post.
     */
    /**
     * Display blog post (own or public read-only).
     */
    public function show(BlogPost $blog)
    {
        if ($blog->status !== 'published') {
            abort(403, 'Not published');
        }

        $isOwner = $blog->user_id === Auth::id();

        return view('blogs.show', compact('blog', 'isOwner'));
    }
}
