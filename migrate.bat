start /B cmd /C php artisan migrate --force
start /B cmd /C php artisan db:seed --class=DatabaseSeeder
start /B cmd /C php artisan serve > nul 2>&1
