## Migrations manual 

The migrations have been created in a chronological order

You can either run all migrations at the same time with this command:
```php
php artisan migrate
```
Or if you want to run a specific migration one-for-one use this example:
```php
php artisan migrate --path=/database/migrations/0001_01_01_000000_create_users_table.php
// This allows you to run the specific migration create user table
php artisan migrate --path/database/migrations/time_and_date_name_of_the_table

```
