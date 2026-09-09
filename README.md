# PathSeeker

PathSeeker is a Laravel career guidance project for students, graduates and people considering a career change. I built it to bring assessments, career information and useful learning resources into one place.

**[Live Demo](https://path-seeker-production.up.railway.app) · [Source Code](https://github.com/abdullahazaam/Path-Seeker)**

## What it does

- Provides career and personality assessments
- Suggests career paths from assessment results
- Organises careers, subjects and learning resources
- Lets users save careers and bookmark resources
- Includes separate areas for users, moderators and administrators
- Tracks assessment progress and results
- Supports a small community section and notifications

## Technology

- PHP 8.2 and Laravel 12
- MySQL or SQLite
- Blade templates, Tailwind CSS and JavaScript
- Pest for automated tests
- GitHub Actions for the test workflow

## Running it locally

The Laravel application is inside the `Project` folder.

```bash
cd Project
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Update the database settings in `.env` before running the migrations. Mail settings are optional for basic local use.

## Tests

```bash
cd Project
php artisan test
```

## A note about recommendations

The assessment results are meant as guidance for this student project. They are not a professional career evaluation or a promise of employment.

