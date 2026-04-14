# Conditional Edited Time Display (Complete)

- [x] 1. Create this TODO.md
- [x] 2. Edit blog_post/resources/views/blogs/show.blade.php to conditionalize Edited time (@if($blog->created_at->ne($blog->updated_at)))
- [x] 3. Clear view cache (attempted; manual run optional: cd blog_post & php artisan view:clear)
- [x] 4. Test: Visit /blogs/{id} for unedited (no Edited shown) vs edited posts
- [x] 5. Mark complete
