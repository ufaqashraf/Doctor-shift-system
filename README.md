Clone the repository with git clone
Copy .env.example file to .env and edit database credentials there
Run composer install
Run php artisan key:generate
Run php artisan migrate --seed (it has some seeded data - see below)
That's it: launch the main URL and login with default credentials admin@admin.com - password