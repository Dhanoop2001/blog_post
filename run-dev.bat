@echo off
cd /d "c:\Users\dhano\OneDrive\Desktop\laravel\blog_post"
npx concurrently -c "#93c5fd,#c4b5fd,#fdba74" "php artisan serve" "php artisan queue:listen --tries=1" "npm run dev" --names="server,queue,vite" --success first
pause
