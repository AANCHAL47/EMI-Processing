# EMI Processing System (Laravel)

This Laravel project dynamically calculates and stores EMI values for each client using raw SQL and follows the repository-service pattern.

## Features
- Secure login system for admin
- EMI calculation with dynamic month-wise columns
- Raw SQL-based dynamic table generation
- Database seeding with sample loan data
- Admin dashboard to view and process EMI data

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
