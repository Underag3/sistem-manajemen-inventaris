# Sistem Manajemen Inventaris Kantor
## PT Telkomsel - Prototype Seleksi Magang Sistem Informasi

Aplikasi berbasis web untuk mengelola inventaris kantor PT Telkomsel. Dibangun menggunakan **Laravel 13**, **MySQL**, **Tailwind CSS**, dan **Alpine.js**.

---

##  Fitur Utama

- **Dashboard** - Ringkasan statistik dengan grafik Chart.js
- **CRUD Barang** - Manajemen data barang dengan upload gambar
- **Kategori** - Pengelompokan barang berdasarkan kategori
- **Peminjaman & Pengembalian** - Transaksi peminjaman dengan manajemen stok otomatis
- **Laporan** - Export PDF dan Excel
- **REST API** - Full CRUD API dengan autentikasi Sanctum
- **Role-Based Access** - Admin, Staff, Manager
- **Dark Mode** - Toggle theme

---

##  Cara Menjalankan

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Instalasi

```bash
# 1. Clone/extract project
cd "Telkom Project"

# 2. Install PHP dependencies
composer install

# 3. Install JS dependencies
npm install

# 4. Setup environment
cp .env.example .env
php artisan key:generate

# 5. Konfigurasi database di .env
# DB_DATABASE=inventory_management
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Jalankan migration & seeder
php artisan migrate --seed

# 7. Buat symbolic link storage
php artisan storage:link

# 8. Compile assets
npm run dev

# 9. Jalankan server
php artisan serve
```

### 🐳 Menjalankan dengan Docker (Nilai Tambahan)

Jika ingin menjalankan aplikasi menggunakan Docker:

```bash
# 1. Build dan jalankan container
docker compose up -d --build

# 2. Jalankan migration & seeder di dalam container
docker compose exec app php artisan migrate --seed

# 3. Buat symbolic link storage di dalam container
docker compose exec app php artisan storage:link
```

Aplikasi dapat diakses melalui `http://localhost:8000`.

### Akun Demo

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| Staff | staff@example.com | password |
| Manager | manager@example.com | password |

---

##  Arsitektur

```
app/
├── Exports/           # Export classes (PDF, Excel)
├── Http/
│   ├── Controllers/   # Web controllers
│   │   └── Api/       # REST API controllers
│   ├── Middleware/     # RoleMiddleware
│   ├── Requests/      # Form Request validation
│   └── Resources/     # API Resources
├── Models/            # Eloquent models
database/
├── migrations/        # Schema definitions
└── seeders/           # Demo data
resources/views/
├── layouts/           # app, sidebar, navbar
├── categories/        # CRUD views
├── products/          # CRUD views
├── borrowings/        # Borrow/return views
└── reports/           # Report views + PDF templates
routes/
├── web.php            # Web routes
└── api.php            # API routes
```

---

##  REST API

Base URL: `http://localhost:8000/api`

### Authentication
```bash
# Login
POST /api/login
Body: { "email": "admin@example.com", "password": "password" }

# Logout
POST /api/logout
Header: Authorization: Bearer {token}

# Get User
GET /api/user
Header: Authorization: Bearer {token}
```

### Products
```bash
GET    /api/products          # List products
POST   /api/products          # Create product
GET    /api/products/{id}     # Show product
PUT    /api/products/{id}     # Update product
DELETE /api/products/{id}     # Delete product
```

### Categories
```bash
GET    /api/categories        # List categories
POST   /api/categories        # Create category
GET    /api/categories/{id}   # Show category
PUT    /api/categories/{id}   # Update category
DELETE /api/categories/{id}   # Delete category
```

### Borrowings
```bash
GET    /api/borrowings            # List borrowings
POST   /api/borrowings            # Create borrowing
GET    /api/borrowings/{id}       # Show borrowing
PATCH  /api/borrowings/{id}/return # Return items
```

---

##  Tech Stack

| Teknologi | Versi | Kegunaan |
|-----------|-------|----------|
| Laravel | 13.x | Framework PHP |
| MySQL | 8.x | Database |
| Tailwind CSS | 4.x | Styling |
| Alpine.js | 3.x | Interaktivitas |
| Chart.js | 4.x | Grafik dashboard |
| Laravel Breeze | - | Authentication |
| Laravel Sanctum | 4.x | API Auth |
| DomPDF | 3.x | Export PDF |
| Maatwebsite Excel | 3.x | Export Excel |

---

##  Lisensi

Proyek ini dibuat sebagai prototype untuk seleksi magang PT Telkomsel.
