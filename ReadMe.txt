========================================================================
PathSeeker - Career Passport
Role-based Career Exploration Platform
Competition Project Submission
========================================================================

Live Production URL:
------------------------------------------------------------------------
Live App URL: https://path-seeker-production.up.railway.app
========================================================================

Project Overview:
PathSeeker is a role-based career exploration platform for Students, 
Graduates, and Professionals featuring a Career Bank, Interest Quiz, 
Multimedia Center, and Resource Library.

Directory Structure:
├── Documentation/   - System architecture, diagrams, and project reports
├── Project/         - Complete Laravel application (Backend, Frontend, Database)
├── Video/           - Project demo and walkthrough presentation video
└── ReadMe.txt       - Setup and submission overview

Quick Setup & Run Instructions:
1. Ensure MySQL (XAMPP or standalone) is running on port 3306.
2. Navigate to the Project folder:
   cd Project
3. Configure .env file (pre-configured with DB_DATABASE=techwiz_db, DB_USERNAME=root).
4. Run migrations & database seeders:
   php artisan migrate:fresh --seed
5. Start development server:
   php artisan serve
6. Open your browser and access:
   - Homepage: http://127.0.0.1:8000/
   - Career Bank: http://127.0.0.1:8000/careers
   - Multimedia Center: http://127.0.0.1:8000/multimedia
   - Resource Library: http://127.0.0.1:8000/resources
   - User Dashboard: http://127.0.0.1:8000/dashboard

Tech Stack:
- PHP 8.2+
- Laravel 12
- MySQL (Database: techwiz_db)
- Tailwind CSS
- Blade Templating Engine
========================================================================

Demo Accounts / Test Credentials:
------------------------------------------------------------------------
Role         | Email                     | Password
------------------------------------------------------------------------
Admin        | admin@pathseeker.com      | admin123
Student      | student@pathseeker.com    | student123
Graduate     | graduate@pathseeker.com   | graduate123
Professional | pro@pathseeker.com        | pro123
========================================================================
