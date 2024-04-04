1- install the composer in the project
2- migrate the database using this cmd :
php artisan migrate --force
3- insert this user for login using this cmd : 
php artisan db:seed --class=DatabaseSeeder
username:admin
pass:asas
4- serve the project with this cmd :
php artisan serve
