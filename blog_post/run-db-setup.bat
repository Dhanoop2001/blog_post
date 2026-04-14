@echo off
cd /d %~dp0
php artisan config:clear
php artisan config:cache
php artisan migrate:fresh --seed
php artisan serve
pause
