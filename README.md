# Uygulama ve Sunucu Envanter Yönetim Sistemi (Laravel + MySQL)

## 1) Teknoloji ve mimari özeti
- **Backend:** Laravel (MVC)
- **Veritabanı:** MySQL
- **Auth:** Session tabanlı klasik login (kullanıcı adı + şifre)
- **Yetkilendirme:** `role:Admin` middleware
- **Frontend:** Blade + Bootstrap 5

## 2) Veritabanı şeması
- `roles (id, name, timestamps)`
- `users (id, role_id, full_name, username, password, remember_token, timestamps)`
- `applications (id, name, description, timestamps)`
- `servers (id, application_id, name, ip_address, operating_system, environment_type, notes, timestamps)`

İlişkiler:
- role 1-N users
- application 1-N servers
- user N-1 role
- server N-1 application

## 3-14) Dosya yapısı
- Migration: `database/migrations`
- Model: `app/Models`
- Seeder: `database/seeders`
- Middleware: `app/Http/Middleware/RoleMiddleware.php`
- Controller: `app/Http/Controllers`
- Route: `routes/web.php`
- View: `resources/views`

## 15) Kurulum ve çalıştırma
1. `cp .env.example .env`
2. `.env` içinde MySQL ayarlarını doldurun.
3. `composer install`
4. `php artisan key:generate`
5. `php artisan migrate --seed`
6. `php artisan serve`

Varsayılan admin:
- kullanıcı_adı: `admin`
- şifre: `Admin123!`
