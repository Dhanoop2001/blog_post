~# Vercel Deployment Configuration TODO

## Plan
- [x] Create `vercel.json` with PHP runtime, routes, and env vars
- [x] Create `api/index.php` serverless entry point
- [x] Create `.vercelignore`
- [x] Update `config/session.php` driver to cookie for serverless
- [x] Update `.gitignore` to exclude `.vercel/`
- [ ] Generate APP_KEY and configure in Vercel dashboard
- [ ] Connect repo to Vercel or deploy via CLI
- [ ] (Production) Connect external database (Vercel Postgres, PlanetScale, etc.)
- [ ] (Production) Configure S3/R2 for persistent file uploads

## Files Created/Modified

### New Files
1. **`vercel.json`** — Vercel deployment configuration
   - Uses `vercel-php@0.7.3` runtime for PHP 8.2+
   - Routes static assets from `public/` and dynamic traffic to `api/index.php`
   - Sets serverless-optimized environment variables (cookie sessions, SQLite at `/tmp`, array cache, stderr logging)

2. **`api/index.php`** — Serverless entry point
   - Redirects Laravel storage to writable `/tmp/storage`
   - Auto-creates storage subdirectories
   - Creates SQLite database at `/tmp/database.sqlite`
   - Bootstraps Laravel application

3. **`.vercelignore`** — Excludes dev files from deployment
   - `.git`, `.env*`, `node_modules`, `vendor`, `.vscode`, IDE configs, logs, etc.

### Modified Files
4. **`config/session.php`** — Changed default session driver from `'file'` to `env('SESSION_DRIVER', 'cookie')` for stateless serverless compatibility

5. **`.gitignore`** — Added `.vercel/` to ignore list

## Next Steps for Deployment

1. **Generate APP_KEY**:
   ```bash
   php artisan key:generate --show
   ```
   Copy the output and set it as `APP_KEY` in Vercel dashboard Environment Variables.

2. **Update APP_URL in `vercel.json`**:
   Replace `https://blog-post.vercel.app` with your actual Vercel deployment URL.

3. **Deploy**:
   - Connect your GitHub repo to Vercel, OR
   - Use Vercel CLI: `vercel --prod`

4. **Production Database** (strongly recommended):
   SQLite at `/tmp` is ephemeral (resets on cold starts). For production, connect an external database:
   - Vercel Postgres
   - PlanetScale
   - Neon
   - Supabase
   Update `DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` in Vercel Environment Variables.

5. **Production File Storage** (strongly recommended):
   Uploaded images stored locally are also ephemeral. For production, configure S3/R2/Cloudflare Storage and update `FILESYSTEM_DISK` env var.
