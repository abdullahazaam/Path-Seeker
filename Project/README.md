# PathSeeker application

This folder contains the Laravel application. For an overview of the project, see the [main README](../README.md).

## Start the application

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Run the tests with:

```bash
php artisan test
```
