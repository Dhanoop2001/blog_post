# TODO: Fix author_id Column Error

## Steps:

- [x] Step 1: Create new migration file to add `author_id` foreign key to blog_posts table
- [x] Step 2: Update `app/Models/BlogPost.php` - remove 'author' from \$fillable
- [x] Step 3: Update `app/Http/Controllers/BlogController.php` - remove author string handling and validation
- [x] Step 4: Update create form `resources/views/auth/blog.blade.php` - remove author input field
- [x] Step 5: Update edit form `resources/views/blogs/edit.blade.php` - remove author input field  
- [x] Step 6: Update index view `resources/views/blogs/index.blade.php` - display author name via \$blog->author->name
- [x] Step 7: Update show view `resources/views/blogs/show.blade.php` - display author name via \$blog->author->name
- [ ] Step 8: Run `php artisan migrate` to add the column
- [ ] Step 9: Test creating a new blog post (no error expected)
- [ ] Step 10: Clear caches `php artisan optimize:clear` and test full CRUD

**All code changes complete. Next: Run migration (Step 8), test (Step 9), clear caches (Step 10).**
