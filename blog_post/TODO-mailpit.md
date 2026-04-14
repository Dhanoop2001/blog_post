# Mailpit Setup - Complete

**Status:** Approved & Ready

## Step 1: Start Mailpit (Docker)
```bash
docker run -d --name mailpit -p 1025:1025 -p 8025:8025 axllent/mailpit:latest
```
- SMTP: localhost:1025
- UI: http://localhost:8025

## Step 2: Configure .env (manual)
Add/Replace in blog_post/.env:
```
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=hello@example.com
QUEUE_CONNECTION=database
```

## Step 3: Laravel Commands
```bash
cd blog_post
php artisan config:clear
php artisan config:cache
php artisan queue:table # if no jobs table
php artisan migrate
php artisan queue:work --stop-when-empty
```

## Step 4: Test
- Go to http://localhost:8000/forgot-password (Laravel default port?)
- Submit email, check Mailpit UI for email.
- Ctrl+C queue worker after test.

## Stop
```bash
docker stop mailpit
docker rm mailpit
```

Done! Emails captured in Mailpit instead of log/Gmail.

