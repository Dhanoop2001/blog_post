# Undo Blog Content Section Changes - Progress Tracker

**Goal:** Revert all recent changes (markdown editor, plain-text toggle, content sanitization/validation) to basic plain text handling.

## Steps:
- [ ] 1. Create this TODO file ✅
- [x] 2. Edit `resources/views/auth/blog.blade.php`: Remove JS markdown converter, link modal, simplify textarea to plain text.
- [x] 3. Edit `resources/views/blogs/edit.blade.php`: Same as step 2.
- [x] 4. Edit `resources/views/blogs/index.blade.php`: Use escaped `{{ Str::limit($blog->content, 150) }}` for excerpts.
- [x] 5. Edit `resources/views/blogs/show.blade.php`: Use `{{ nl2br(e($blog->content)) }}` for content display.
- [x] 6. Edit `app/Http/Controllers/BlogController.php`: Remove strip_tags sanitization, loosen content validation to min:10.
- [ ] 7. Test: Create blog with markdown-like text, verify plain storage/display.
- [ ] 8. Clear caches: `php artisan cache:clear view:clear route:clear`
- [ ] 9. Mark complete & attempt_completion.

**Current step: 1/9 ✅**

