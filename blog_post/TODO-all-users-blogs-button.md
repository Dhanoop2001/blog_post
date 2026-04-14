# Add "View All Users Blogs" Button

## Status: ✅ Complete

- [x] 1. Create TODO ✅
- [x] 2. Add button to blogs/index.blade.php header ✅
  - Added "All Users Blogs" btn (outline-light lg, globe icon) next to "New Post"
  - Links to {{ route('public.blogs') }} (existing public published blogs)
- [x] 3. Route/controller ✅
  - Added Route::get('/blogs/all') -> publicIndex with auth middleware
  - New view all-blogs/index.blade.php (styled like public, with dashboard links)
  - Button links to route('blogs.all')
- [x] 4-7. Controller/route/view/test ✅
  - Updated publicIndex() to render all-blogs/index.blade.php for /blogs/all
  - Route /blogs/all with auth (dashboard-accessible)
  - all-blogs/index.blade.php created (dashboard-styled with My Blogs back btn)
  - Button /blogs/all works without 403
- [x] 8. Complete ✅

**Goal:** Button in private /blogs to show all users' published blogs (like public page but accessible from dashboard).

Last updated: $(date)
