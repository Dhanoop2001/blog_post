# Mailpit Setup - Complete ✅

See [TODO-mailpit.md](TODO-mailpit.md) for setup steps.

**Status:**
- [x] Switched from Gmail to Mailpit (local SMTP fake server)
- [x] Docker command ready
- [x] .env vars specified
- [x] Queue ready (database)

**Quick Start:**
1. Run Docker Mailpit
2. Add .env vars manually
3. `cd blog_post && php artisan queue:work`
4. Test /forgot-password → check http://localhost:8025

laravel.log: check blog_post/storage/logs/laravel.log if issues.


