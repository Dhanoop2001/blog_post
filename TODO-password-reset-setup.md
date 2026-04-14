# Password Reset Flow Setup - Mailpit Integration

Status: In progress

## Steps:
- [x] 1. Update config/mail.php default mailer to 'smtp'
- [ ] 2. Start Mailpit: `mailpit-bin/mailpit.exe`
- [ ] 3. Set .env vars (manual): MAIL_MAILER=smtp, MAIL_HOST=127.0.0.1, MAIL_PORT=1025, MAIL_USERNAME=null, MAIL_PASSWORD=null, MAIL_ENCRYPTION=null, QUEUE_CONNECTION=database
- [ ] 4. Run: `cd blog_post && php artisan config:clear && php artisan queue:table && php artisan migrate`
- [ ] 5. Start server: `cd blog_post && php artisan serve`
- [ ] 6. Start queue: New terminal `cd blog_post && php artisan queue:work`
- [ ] 7. Test: http://127.0.0.1:8000/forgot-password → Submit registered email → Check http://localhost:8025 → Follow link → Reset & login
- [ ] 8. Cleanup/Stop: Ctrl+C serve/queue, close Mailpit

**Notes**: Password controllers/views/routes already perfect. User model Notifiable ✅.

