## Laravel repository with Simple News Package && Orchid admin panel

## Installation using Docker

1. Clone the project using Git.
2. Run `make install-backend`.
3. Inside the `php` container, run the following commands:
    ```bash
    php artisan migrate
    php artisan orchid:admin admin admin@admin.com password
    php artisan db:seed --class=CategorySeeder
    ```
4. Open in a browser: http://localhost:90
