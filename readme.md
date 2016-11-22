# sample-task-list

#####Steps to get things up and running:

1. clone repo to wherever your php server is running - I put my project in xampp/htdocs/laravel. This part may work wherever though with the command later on (haven't really tried it out yet).
2. add a basic sqlite file in the "database" folder called "database.sqlite".
3. If not already, install composer (if windows, you'll need to sign out or restart after install)
4. In the newly cloned folder, run "composer install" in the terminal
5. After finished, run the initial migrations to get database going with "php artisan migrate"
6. To start a basic server, do "php artisan serve". This *should* work anywhere as long as php and composer are on the machine. If you want to forward the server through port forwarding, you must specify the domain (and optional custom port): "php artisan serve --host=0.0.0.0 --port=8000"
7. Access the site with either localhost:8000, or your custom setup if being forwarded.

Tests can be run by entering the new repo folder and doing "phpunit" in the terminal.