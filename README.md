# SADBMS

SADBMS (Service and Attachment Database Management System) is a Laravel app for managing service and attachment personnel records. It supports role-based access for admins and personnel, profile CRUD, search, photo uploads, and separate dashboards.

## Key Features

- Laravel 12 (PHP 8.2+)
- MySQL database
- Role-based accounts: `admin` and `personnel` (chosen at signup)
- Single login that redirects by stored role
- Route guards via `role` middleware (`admin` vs `personnel`)
- Admin registration protected by a verification code emailed to `ADMIN_REGISTRATION_EMAIL`
- Password reset via email link
- Personnel profile management: create, view, search, edit, delete (admin)
- Personnel self-service dashboard and profile form
- Photo uploads on the `public` disk
- Tailwind CSS + Vite frontend tooling
- Local branding assets (logo / favicon under `public/`)

## What SADBMS Can Do

- Store and organize service and attachment personnel records
- Restrict admin and personnel areas by role
- Create profiles with contact, assignment, and deployment details
- View and paginate listings by category
- Search profiles by name, email, department, or ID
- Edit records and update profile photos
- Remove profiles (admin only)
- Register admins only after a one-time code is received at the configured admin email

## Project Structure

- `app/Http/Controllers` — auth, password reset, and personnel operations
- `app/Http/Middleware` — `EnsureUserRole`, `PreventBrowserCache`
- `app/Models` — `User`, `Personel`
- `routes/web.php` — guest, shared, admin-only, and personnel-only routes
- `resources/views` — Blade templates for auth, dashboards, and profiles
- `resources/css` — Vite-built stylesheets
- `database/migrations` — users, personels, sessions, password resets
- `public/` — built assets, favicon, logo, and storage symlink target

## Setup

1. Copy the environment file:
    ```bash
    cp .env.example .env
    ```
2. Configure `.env`:
    - **App:** `APP_URL` (e.g. `http://sadbms.test` or `http://localhost:8000`)
    - **Database:** `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
    - **Mail (required for admin codes and password reset):**
      - `MAIL_MAILER=smtp` (use `log` only for local debugging — mail will not leave the server)
      - `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_SCHEME`
      - `MAIL_FROM_ADDRESS`, `MAIL_FROM_NAME`
      - `ADMIN_REGISTRATION_EMAIL` — inbox that receives admin signup verification codes
3. Install dependencies:
    ```bash
    composer install
    npm install
    ```
4. Generate the app key:
    ```bash
    php artisan key:generate
    ```
5. Run migrations:
    ```bash
    php artisan migrate
    ```
6. Link public storage (required for profile photos):
    ```bash
    php artisan storage:link
    ```
7. Build frontend assets (or use the Vite dev server):
    ```bash
    npm run build
    # or: npm run dev
    ```
8. Serve the app (Laragon virtual host, or):
    ```bash
    php artisan serve
    ```

### Mail tip (Gmail)

Use an [App Password](https://myaccount.google.com/apppasswords) (not your normal Gmail password), then set for example:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@gmail.com
MAIL_PASSWORD=your-16-char-app-password
MAIL_SCHEME=smtp
MAIL_FROM_ADDRESS="your@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
ADMIN_REGISTRATION_EMAIL=your@gmail.com
```

After changing mail settings:

```bash
php artisan config:clear
```

## Authentication Flow

1. Visit `/` (or `/login`) for the single login form — no admin/personnel toggle.
2. Visit `/register` to create an account and choose role (`admin` or `personnel`).
3. Admin signup: request a verification code → code is emailed to `ADMIN_REGISTRATION_EMAIL` → enter the code to finish registration.
4. After login:
   - `admin` → `/dashboard`
   - `personnel` → `/personnelsdashboard`
5. Forgot password: `/forgot-password` → email reset link → `/reset-password/{token}`.

## Roles and Access

| Role | Home | Can access |
|------|------|------------|
| `admin` | `/dashboard` | Admin dashboard, view/search/add/edit/remove profiles |
| `personnel` | `/personnelsdashboard` | Personnel dashboard, profile listing, add/update own profile form |

Wrong-role URLs return **403**.

## Important Routes

### Guest

| Method | Path | Purpose |
|--------|------|---------|
| GET | `/`, `/login` | Login |
| POST | `/login` | Authenticate |
| GET | `/register` | Signup |
| POST | `/register` | Create account |
| POST | `/send-admin-code` | Send admin verification code |
| POST | `/resend-admin-code` | Resend admin code |
| GET | `/forgot-password` | Request password reset |
| POST | `/forgot-password` | Send reset link |
| GET | `/reset-password/{token}` | Reset form |
| POST | `/reset-password` | Update password |

### Admin (`auth` + `role:admin`)

| Method | Path | Purpose |
|--------|------|---------|
| GET | `/dashboard` | Admin dashboard |
| GET | `/viewprofile` | View / filter profiles |
| GET | `/addprofile` | Add profile form |
| POST | `/create_post` | Create/update profile (also allowed for personnel) |
| GET | `/searchprofile` | Search profiles |
| GET | `/editprofile/{id}` | Edit form |
| POST | `/editprofile` | Save edits |
| GET/POST | `/removeprofile` | Find and delete profiles |

### Personnel (`auth` + `role:personnel`)

| Method | Path | Purpose |
|--------|------|---------|
| GET | `/personnelsdashboard` | Personnel home |
| GET | `/personnel` | Profile listing |
| GET | `/personnel/add-profile` | Add/update own profile |

### Shared authenticated

| Method | Path | Purpose |
|--------|------|---------|
| POST | `/logout` | Log out |

## Notes

- Admin verification codes go to `ADMIN_REGISTRATION_EMAIL` in `.env` (see `config/mail.php`), not to the new user's email.
- With `MAIL_MAILER=log`, messages are written to `storage/logs/laravel.log` only.
- Profile photos need `php artisan storage:link` so `public/storage` serves uploads.
- Frontend assets need `npm run build` (or a running `npm run dev`) so `@vite` can resolve `public/build/manifest.json`.

## Scripts

- `npm run dev` — Vite development server (hot reload)
- `npm run build` — production frontend build
- `composer test` or `php artisan test` — run tests

## License

This project is distributed under the MIT License.
