# PathSeeker Laravel Application

This directory contains the Laravel 12 application for **PathSeeker — Career Passport**.

For the feature overview, live demo, architecture, setup instructions, and portfolio notes, see the [repository README](../README.md).

## Quick start

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Run the automated checks with:

```bash
php artisan test
```

