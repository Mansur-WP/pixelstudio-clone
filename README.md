# 📸 PixelStudio: Multi-Tenant Photography ERP

PixelStudio is a premium, high-performance photography management platform designed for world-class studios. It features a triple-tier architecture (Platform, Admin, Staff) with absolute tenant isolation and a luxury user interface.

## 🚀 Key Features

### 🛡️ Platform Administration
- **Studio Provisioning**: Rapid workspace setup with automatic admin account creation.
- **Global Monitor**: Real-time analytics and activity logs across all active studios.
- **Plan Management**: Seamless toggling between Free and Pro tiers.

### 🏢 Studio Command Center (Admin)
- **Staff Orchestration**: Comprehensive CRUD operations for photography teams.
- **Financial Control**: Centralized invoice management and payment tracking.
- **Settings**: Complete control over studio identity and operational defaults.

### 🎨 Production Hub (Staff)
- **Client Management**: Pro-grade CRM for managing sessions and deliverables.
- **Gallery Intelligence**: Automated, tokenized private galleries for client review.
- **Financial Logistics**: Rapid invoice generation and payment status toggling.

---

## 🛠️ Tech Stack
- **Framework**: Laravel 13
- **Frontend**: Tailwind CSS & Alpine.js
- **Database**: SQLite (Production-ready local storage)
- **Aesthetic**: Custom "Rich Aesthetic" Design System

---

## 🏁 Setup Instructions

### 1. Prerequisites
Ensure you have **PHP 8.2+** and **Composer** installed.

### 2. Installation
```bash
# Clone the repository
git clone [your-repo-url]
cd pixelstudio

# Install PHP dependencies
composer install

# Install JS dependencies
npm install && npm run dev
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Update database configuration in .env
# DB_CONNECTION=sqlite
```

### 4. Database Initialization
```bash
# Create the sqlite file
touch database/database.sqlite

# Run migrations and seeders
php artisan migrate --seed
```

### 5. Launch
```bash
php artisan serve
```

---

## 🔐 Security Audit Results
The platform has undergone a professional security audit focusing on:
- **Tenant Isolation**: Strict global scopes for `studio_id`.
- **RBAC**: Multi-layered Role Based Access Control.
- **Mass Assignment Protection**: Guarded attributes on sensitive models.

---

## 📄 License
Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
