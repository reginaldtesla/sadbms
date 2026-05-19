# SADBMS

SADBMS is a Laravel-based personnel database system for managing service and attachment personnel records. It provides role-based authentication, profile creation, search, edit, and deletion workflows, plus separate dashboards for admins and personnel.

## Key Features

- Laravel 12 application using PHP 8.2
- MySQL database backend
- Role-based login for `admin` and `personnel`
- Admin registration protected by a verification code email flow
- Personnel profile management: create, view, search, edit, delete
- Separate dashboards for service and attachment personnel
- File upload support for personnel photos
- Tailwind CSS + Vite frontend tooling

## What SADBMS Can Do

- Store and organize service and attachment personnel records in a centralized database
- Support role-based access for administrators and regular personnel users
- Create new personnel profiles with contact, assignment, and deployment details
- View and paginate personnel listings by category and date
- Search profiles by name, email, department, or ID
- Edit existing personnel records and update profile photos
- Remove obsolete or retired personnel records safely
- Manage admin registration via secure verification code delivery

## What It Is Used For

- Managing service personnel assignments, attachments, and deployments
- Tracking personnel details across departments and supervision chains
- Providing admins with separate dashboards for oversight and reporting
- Helping personnel access and review their own records securely
- Running personnel record maintenance in organizations with service and attachment units

## Project Structure

- `app/Http/Controllers` - application controllers for authentication and personnel operations
- `app/Models` - `User` and `Personel` models
- `routes/web.php` - web routes for login, dashboard, profile management, and personnel views
- `resources/views` - Blade templates for auth, dashboards, profile forms, and results pages
- `database/migrations` - schema definitions for users, personels, and related entities

## Setup

1. Copy environment example:
    ```bash
    cp .env.example .env
    ```
2. Configure your `.env` values for:
    - `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
    - `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_ENCRYPTION`, `MAIL_FROM_ADDRESS`

3. Install PHP dependencies:
    ```bash
    composer install
    ```
4. Install Node dependencies:
    ```bash
    npm install
    ```
5. Generate application key:
    ```bash
    php artisan key:generate
    ```
6. Run database migrations:
    ```bash
    php artisan migrate
    ```
7. Create storage symlink for uploaded files:
    ```bash
    php artisan storage:link
    ```
8. Start development servers:
    ```bash
    npm run dev
    php artisan serve
    ```

## Authentication Flow

- Visit `/` to access the login page
- Visit `/register` to create a new personnel account
- Admin registration requires an email verification code sent to the configured administrator email
- Admin users are redirected to `/dashboard`
- Personnel users are redirected to `/personnel`

## Important Routes

- `GET /` - login page
- `GET /register` - signup form
- `POST /login` - login request
- `POST /register` - registration request
- `GET /dashboard` - admin dashboard
- `GET /personnel` - personnel listing
- `GET /viewprofile` - view and filter personnel profiles
- `GET /addprofile` - add personnel profile page
- `GET /searchprofile` - search personnel profiles
- `GET /editprofile/{id}` - edit profile page
- `POST /editprofile` - update profile submission
- `GET /removeprofile` - remove profile page
- `POST /removeprofile` - delete profile action

## Notes

- The admin verification code is generated and mailed from the app. Ensure the mail settings in `.env` are configured correctly.
- Uploaded photos are stored using the `public` disk and served through the storage symlink.
- The default admin email is configured in `UserController`.

## Scripts

- `npm run dev` - start Vite development server
- `npm run build` - build frontend assets for production
- `composer test` or `php artisan test` - run application tests

## License

This project is distributed under the MIT License.
