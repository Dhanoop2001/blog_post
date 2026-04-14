# TODO: Switch to XAMPP MySQL (Plan Breakdown)

## Steps:
- [x] 1. Clear and recache config: Run `cd blog_post && php artisan config:clear && php artisan config:cache` manually (CMD syntax: cd blog_post ^& php artisan config:clear)
- [x] 2. Check migrations status: Run `cd blog_post && php artisan migrate:status` manually
- [x] 3. Fresh migrations on MySQL: Run `cd blog_post && php artisan migrate:fresh --seed` manually
- [x] 4. Test server: Run `cd blog_post && php artisan serve` (visit http://127.0.0.1:8000)
- [x] 5. Verify in phpMyAdmin: tables in 'blog_post' DB (users, blog_posts, migrations)

**Status:** Already configured for MySQL in .env. No SQLite file. Proceed step-by-step.

Updated as steps complete.
