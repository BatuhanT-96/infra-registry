# Application & Server Inventory Management System

## Project Description
Application & Server Inventory Management System is a web-based infrastructure inventory platform built with Laravel. It helps teams manage business applications and the servers those applications run on from a single interface.

The system is designed to provide a structured inventory for infrastructure operations, including:
- Application records and details
- Server inventory linked to applications
- Environment-based organization (Test / Pre-Prod / Prod)
- Operating system catalog management
- Dashboard analytics for infrastructure visibility
- Secure login and role-based permissions

## Features
- **Application management**
  - Create, edit, delete, and view application records
  - Store descriptions and inspect related servers per environment
- **Server inventory management**
  - Create, update, and remove server records
  - Track server name, IP address, operating system, environment, and notes
- **Environment grouping**
  - Classify servers by **Test**, **Pre-Prod**, and **Prod**
- **Operating system management**
  - Maintain a reusable list of operating systems
  - Mark operating systems as active/inactive
- **Server filtering and sorting**
  - Search by keywords
  - Filter by application and environment
  - Sort by name, application, IP, operating system, and environment
- **Dashboard with statistics and charts**
  - Total applications and servers
  - Environment distribution chart
  - Operating system distribution chart
- **User authentication**
  - Username/password login with session-based authentication
- **Role-based access control (Admin / User)**
  - Admin-only management for users and operating systems

## Technology Stack
- **Backend:** Laravel 11, PHP 8.2+
- **Database:** MySQL
- **Frontend Rendering:** Blade templates
- **Asset Tooling:** Vite
- **Styling/UI:** Custom CSS, Tailwind CSS (build dependency), Google Fonts
- **Charts:** Chart.js (CDN)
- **HTTP Client (frontend dependency):** Axios

> Note: The UI is primarily custom-styled Blade pages. Bootstrap is not currently included as a project dependency.

## System Architecture
The project follows Laravel's **MVC architecture**:

- **Models**
  - `Application`, `Server`, `OperatingSystem`, `User`, and `Role`
  - Define relationships and domain structure for inventory data
- **Controllers**
  - Handle request flow, business rules, and CRUD logic
  - Include dedicated controllers for dashboard, auth, applications, servers, users, and operating systems
- **Views (Blade)**
  - Render dashboard and management pages
  - Include forms, lists, filters, and chart visualizations
- **Middleware**
  - Authentication middleware protects internal routes
  - Custom role middleware enforces admin-only modules
- **Database Relationships**
  - Applications own many servers
  - Operating systems are referenced by servers
  - Roles are assigned to users for access control

## Database Structure
Main tables:

- **`users`**
  - Stores user accounts and authentication data
  - References role via `role_id`
- **`roles`**
  - Defines access levels (e.g., Admin, User)
- **`applications`**
  - Stores application inventory data
- **`servers`**
  - Stores server records linked to applications
  - Includes environment, IP address, notes, and linked operating system
- **`operating_systems`**
  - Stores operating system master data

### Relationships
- `roles` **1 → N** `users`
- `applications` **1 → N** `servers`
- `operating_systems` **1 → N** `servers`
- `users` **N → 1** `roles`
- `servers` **N → 1** `applications`
- `servers` **N → 1** `operating_systems`

## Installation
### Prerequisites
- PHP 8.2+
- Composer
- MySQL
- Node.js + npm (for frontend asset build)

### Steps
1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd infra-registry
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Create environment file:
   ```bash
   cp .env.example .env
   ```

4. Configure `.env`:
   - Set `DB_CONNECTION=mysql`
   - Fill in `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

5. Generate app key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations:
   ```bash
   php artisan migrate
   ```

7. Seed initial data:
   ```bash
   php artisan db:seed
   ```

8. (Optional) Install and build frontend assets:
   ```bash
   npm install
   npm run build
   ```

9. Start local server:
   ```bash
   php artisan serve
   ```

Quick command sequence:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

## Default Login Credentials
Seed data creates a default admin account:

- **Username:** `admin`
- **Password:** `Admin123!`

(An additional standard user may also be seeded depending on current seed files.)

## Usage
1. Open the app in your browser and log in.
2. Go to **Applications** to create and manage application records.
3. Go to **Servers** to add server entries and assign them to applications.
4. Manage **Operating Systems** (Admin) and keep OS options up to date.
5. Use dashboard cards and charts for quick infrastructure visibility.
6. Filter and sort server records to find assets by environment, app, IP, or OS.

## Dashboard
The dashboard provides infrastructure-level visibility with:

- **Total count widgets**
  - Total applications
  - Total servers
  - Environment totals (Test, Pre-Prod, Prod)
- **Environment distribution pie/doughnut chart**
  - Shows server distribution by environment
- **Operating system distribution pie/doughnut chart**
  - Shows server distribution by OS

## Screenshots
Add screenshots here as the project evolves:

- `docs/screenshots/dashboard.png` — Dashboard
- `docs/screenshots/server-list.png` — Server List
- `docs/screenshots/application-detail.png` — Application Detail
- `docs/screenshots/operating-systems.png` — Operating System Management

## Security Notes
- Authentication is based on **username/password** with Laravel session auth.
- Authorization is enforced via **role-based access control** (Admin/User).
- Admin-only routes are protected by role middleware.
- Use strong passwords and production-grade environment/security settings before deployment.

## Future Improvements
Possible enhancements:
- REST API support for external integrations
- Audit logging for CRUD and authentication events
- Email or in-app notifications
- Infrastructure integrations (CMDB/cloud sync)
- Advanced reporting and export options

## License
This project is open-source and available under the **MIT License**.
