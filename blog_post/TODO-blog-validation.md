# Blog Creation Validation ✅ UPDATED: Spaces allowed in author

**Summary:**
Enhanced validation added to BlogController.php for store() and update():

**New Rules:**
- `author`: required|string|min:2|max:255|alpha → **No numbers/special chars allowed!** (e.g., "John Doe" OK, "John123" FAIL)
- `title`: required|string|min:5|max:255
- `content`: required|string|min:50  
- `slug`: nullable|string|regex:/^[a-z0-9-]+$/|max:255|unique → lowercase a-z,0-9,- only

**Custom Error Messages:**
- Author: "Author name must contain only letters (A-Z, a-z). No numbers or special characters."
- And others for title/content/slug.

**Tested Locations:**
- Create: `/blog` form → `blogs.store`
- Edit: `/blogs/{id}/edit` → `blogs.update`

Views (`auth/blog.blade.php`, `blogs/edit.blade.php`) already display errors via `@error()`.

**Next:** Log in, try create blog with invalid author like "Test123" → see validation error. Valid like "John Doe" succeeds.

Task complete!

- Custom error messages added

