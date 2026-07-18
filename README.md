# Jueli Engineering Ltd

A Laravel-based company website and admin panel for Jueli Engineering Ltd, an engineering products and services company. Rebuilt from a legacy plain-PHP site into a full Laravel application with a public marketing site and a permission-controlled admin dashboard.

## Public site

- Home, About, Services, Shop (with category filtering) and Contact pages
- Contact form submissions are stored and reviewable from the admin panel
- Product catalog with categories and featured items

## Admin panel

- Role-based access control (Super Admin, Manager, Editor roles) with granular permissions
- Product, category, and team management with image uploads, price, and status tracking
- Sortable, filterable data tables with Print / Excel / PDF / CSV export
- Activity log tracking create/update/delete actions across the app
- Basic website visitor tracking
- Website settings, user management, and roles & permissions screens

## Stack

- Laravel, MySQL, Blade
- Bootstrap 5, vanilla JS (no jQuery)
- `maatwebsite/excel` and `barryvdh/laravel-dompdf` for exports

## Local setup

```bash
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
# configure DB_* variables in .env for your local MySQL instance
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Visit `http://127.0.0.1:8000` for the public site and `http://127.0.0.1:8000/admin/` for the admin login.

The seeder creates a demo Super Admin account (`admin@jueli.test` / `password`) — **change this immediately** in any non-local environment.
