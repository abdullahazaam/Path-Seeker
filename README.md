# PathSeeker — Career Passport

[![Live demo](https://img.shields.io/badge/Live%20Demo-Railway-6c4cff)](https://path-seeker-production.up.railway.app/)

PathSeeker is a role-based career exploration platform for students, graduates, and professionals. It combines structured career content, an interest assessment, saved resources, progress tracking, and a shareable digital career passport in one Laravel application.

## Highlights

- Student, graduate, professional, and administrator experiences
- Career bank with search and autocomplete
- Interest quiz with stored attempts and recommendations
- Digital career passport with private sharing and PDF export
- Multimedia centre and resource library with ratings and progress
- Bookmarks with private notes and PDF export
- Email verification, password recovery, profile management, and resume upload
- Notifications, feedback conversations, newsletter subscriptions, and moderated success stories
- Admin CRUD and moderation workflows
- Feature tests for authentication, routes, quiz phases, notifications, feedback, and access rules

## Technology

| Layer | Technology |
| --- | --- |
| Backend | PHP 8.2+, Laravel 12 |
| UI | Blade, Tailwind CSS, Vite |
| Data | MySQL in development/production; SQLite in automated tests |
| Testing | PHPUnit through Laravel's test runner |
| Deployment | Railway |

## Project structure

The Laravel application is inside `Project/`.

```text
Path-Seeker/
├── Project/         Laravel application
├── Documentation/   Project and architecture material
├── Video/           Demonstration media
└── README.md         Portfolio and setup guide
```

## Local setup

```bash
git clone https://github.com/abdullahazaam/Path-Seeker.git
cd Path-Seeker/Project
composer install
cp .env.example .env
php artisan key:generate
```

Create a MySQL database, fill the `DB_*` values in your untracked `.env`, then run:

```bash
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Open `http://127.0.0.1:8000`.

## Tests

The test configuration uses an in-memory SQLite database and does not require local MySQL credentials.

```bash
cd Project
composer install
php artisan test
```

## Demo accounts

Seeded accounts are intended for local/portfolio demonstration only. Review the current seeders before publishing credentials and never reuse their passwords for real accounts.

## Configuration and security

- Copy `.env.example` to `.env`; never commit `.env`.
- Configure real mail, database, and third-party credentials only through environment variables.
- Uploaded resumes and user documents require private storage controls in a real deployment.
- The recommendation output is educational guidance, not a guarantee of employment or salary.

## Author

**Abdullah Azaam** — web developer working with Laravel, PHP, ASP.NET Core, C#, and SQL databases.

