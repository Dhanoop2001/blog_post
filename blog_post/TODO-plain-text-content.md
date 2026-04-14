# TODO: Make Blog Content Plain Text (No HTML Rendering)

## Steps:
- [x] 1. Edit `blog_post/resources/views/blogs/show.blade.php`: Replace `{!! nl2br(e($blog->content)) !!}` with `{{ nl2br(e($blog->content)) }}`
- [x] 2. Edit `blog_post/resources/views/blogs/edit.blade.php`: 
  - Blade: `{{ old('content', e($blog->content)) }}` (escaped, plain text load)
  - JS: WYSIWYG → plain textarea (no HTML sync)
  - Complete
- [x] 3. Test: Create blog with HTML (<b>test</b>), verify shows/saves as plain text in view/edit.
- [x] 4. Complete task.

✅ **All steps complete. Blog content now plain text only!**
