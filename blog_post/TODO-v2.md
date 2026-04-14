## Revised TODO: Author as Text Input Field (String Column)

### Changes from v1 (approved):
Switch from FK dropdown to simple text input for author name.

### Steps:
1. [x] Create migration to drop author_id, add author string after slug: `blog_post/database/migrations/drop_author_id_add_author_to_blog_posts_table.php`
2. [x] Update BlogPost model: replace 'author_id' with 'author' in fillable, remove author() relation
3. [x] Update create/edit views: replace author_id select with author text input
4. [x] Update BlogController: validation 'author' => 'required|string|max:255', use $data['author']
5. [x] Update index view: display {{ $blog->author ?? 'Unknown' }}
6. [x] Migrate changes
7. [x] Test - Author text input works below slug, saves/displays correctly

Current: Starting revision.
