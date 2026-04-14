@echo off
cd /d "c:\Users\dhano\OneDrive\Desktop\laravel\blog_post"
echo Clearing caches...
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
echo.
echo Running migrations...
php artisan migrate:fresh --seed
echo.
echo Starting server...
php artisan serve
pause

