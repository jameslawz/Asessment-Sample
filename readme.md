# Asessment Sample

```sh
cd to_your_directory
composer install
cp .env.example .env
```

1. Update your own DB access in the .env file
```sh
DB_DATABASE=YOUR_DATABASE
DB_USERNAME=YOUR_USERNAME
DB_PASSWORD=YOUR_PASSWORD
```
2. Run commands
```sh
php artisan key:generate
php artisan migrate
php artisan db:seed --class=ContentTableSeeder
```
