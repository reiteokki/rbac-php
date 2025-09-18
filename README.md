# RBAC PHP (Laravel 12)

A minimal role-based access control starter built on Laravel 12 with simple `super` vs `viewer` roles. Super admins can create users. The users list is available on the Dashboard for super admins only.

Postman:
https://www.postman.com/reyvido-yoga/workspace/public-workspace/collection/46801969-f556cb97-d8ba-4302-9f6b-115f672b7d4b?action=share&creator=46801969

## Requirements
- PHP 8.2+
- Composer
- Node.js 18+
- MySQL (or SQLite) configured via `.env`

## Quick start

1) Install dependencies
```bash
composer install
npm install && npm run build
```

2) Environment
```bash
cp .env.example .env
php artisan key:generate
```
Configure your database in `.env` (MySQL recommended). Optional helper to create DB:
```bash
php artisan db:create
```

3) Migrate and seed
```bash
php artisan migrate --seed
```
This seeds roles and a default admin user.

- Email: demo@example.com
- Password: password123
- Role: super

4) Serve the app
```bash
php artisan serve
```
Visit `http://127.0.0.1:8000`.

## App overview
- Authentication: Laravel Breeze
- Roles: `roles` table, user has `role_id`
- Middleware: `role:NAME` enforced via alias in `bootstrap/app.php`
- Admin abilities (super only):
  - Dashboard (`/dashboard`): lists users with pagination
  - Create user (`/admin/users/create`)

## Key files
- Models: `app/Models/User.php`, `app/Models/Role.php`
- Middleware: `app/Http/Middleware/RoleMiddleware.php`
- Routes: `routes/web.php`
- Views: `resources/views/dashboard.blade.php`, `resources/views/admin/users/create.blade.php`

## Common commands
```bash
php artisan optimize:clear   # clear caches
php artisan migrate:fresh --seed
npm run dev                  # Vite dev server (if you switch to dev assets)
```

## Notes
- The `role` middleware is registered in `bootstrap/app.php` using the new Laravel 11+/12 config API.
- Users list is intentionally removed from `/admin/users` and shown in `/dashboard` for super admins.
