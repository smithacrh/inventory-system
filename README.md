# Inventory Management System

Sistem manajemen inventory perusahaan berbasis web menggunakan CodeIgniter 3 dan Tailwind CSS dengan theme toggle light/dark.

## 📋 Requirements

- PHP 7.4.23
- CodeIgniter 3
- Tailwind CSS
- MySQL/MariaDB
- Apache/Nginx
- Composer (opsional)

## 🔧 Setup Instructions

### 1. Clone Repository
```bash
git clone https://github.com/smithacrh/inventory-system.git
cd inventory-system
```

### 2. Setup Database
```sql
CREATE DATABASE db_kju;
```

Import file `database/db_kju.sql`:
```bash
mysql -u root -p db_kju < database/db_kju.sql
```

### 3. Configure CodeIgniter
- Edit `application/config/database.php`
- Sesuaikan `$db['default']` dengan kredensial database Anda

```php
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => 'your_password',
    'database' => 'db_kju',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8mb4',
    'dbcollat' => 'utf8mb4_unicode_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
```

### 4. Install Dependencies
```bash
npm install
npm run dev  # untuk development
npm run build  # untuk production
```

### 5. Set File Permissions
```bash
chmod -R 755 application/
chmod -R 755 system/
chmod -R 755 public/
```

### 6. Configure Web Server (Apache)

Edit file `.htaccess` atau create file baru:
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L]
</IfModule>
```

### 7. Access Application
```
http://localhost/inventory-system
```

**Default Login Credentials:**
- Username: `admin`
- Password: `password123`

## 👥 User Roles & Permissions

### Level 1 - Admin
- Full Access ke semua fitur
- Manajemen User
- Akses Dashboard lengkap
- Export Report

### Level 2 - Operator Assembly
- Akses Produksi Barang
- View Stok Barang
- View Consumer
- Lihat Dashboard

### Level 3 - Operator Cutting
- Akses Pemotongan Barang
- View Stok Barang
- View Dashboard

### Level 4 - Driver
- Akses Surat Jalan (Delivery)
- View Consumer
- Print Surat Jalan

## 📱 Features

### Dashboard & Analytics
- ✅ Dashboard dengan statistik real-time
- ✅ Overview total konsumen, barang, produksi, pengiriman
- ✅ Recent activities (5 produksi & pengiriman terakhir)
- ✅ Stock summary dengan sorting
- ✅ Grafik dan statistik

### Management Modules
- ✅ **Manajemen Konsumen** - CRUD, Search
- ✅ **Manajemen Kategori Barang** - CRUD
- ✅ **Manajemen Stok Barang** - CRUD, Low Stock Alert
- ✅ **Produksi Barang** - Create, Edit, Delete, Auto Update Stock
- ✅ **Pemotongan Barang** - Create, Edit, Delete, Auto Decrease Stock
- ✅ **Surat Jalan (Delivery)** - Create, Edit, Delete, Print

### Reporting
- ✅ **Laporan Stok Barang** - Complete inventory report dengan total value
- ✅ **Laporan Produksi** - Date range, grouped by item
- ✅ **Laporan Pemotongan** - Date range, grouped by item
- ✅ **Laporan Pengiriman** - Date range, grouped by consumer
- ✅ **Laporan Limbah/Waste** - Calculation production vs cutting vs delivery

### User Management
- ✅ User CRUD (Admin only)
- ✅ Role-based access control
- ✅ Password hashing dengan bcrypt
- ✅ Session management

### UI/UX
- ✅ Dark/Light Theme toggle
- ✅ Responsive Design (Mobile-friendly)
- ✅ Tailwind CSS styling
- ✅ Clean & modern interface
- ✅ Flash messages & notifications

## 📁 Folder Structure

```
inventory-system/
├── application/
│   ├── controllers/
│   │   ├── Auth.php
│   │   ├── Dashboard.php
│   │   ├── Consumer.php
│   │   ├── Category.php
│   │   ├── Item.php
│   │   ├── Production.php
│   │   ├── Cutting.php
│   │   ├── Delivery.php
│   │   ├── Report.php
│   │   └── User.php
│   ├── models/
│   │   ├── User_model.php
│   │   ├── Consumer_model.php
│   │   ├── Category_model.php
│   │   ├── Item_model.php
│   │   ├── Production_model.php
│   │   ├── Cutting_model.php
│   │   ├── Delivery_model.php
│   │   └── Report_model.php
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── header.php
│   │   │   └── footer.php
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   └── register.php
│   │   ├── dashboard/
│   │   │   ├── index.php
│   │   │   └── statistics.php
│   │   ├── consumer/
│   │   ├── category/
│   │   ├── item/
│   │   ├── production/
│   │   ├── cutting/
│   │   ├── delivery/
│   │   ├── report/
│   │   └── user/
│   ├── config/
│   └── ...
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── script.js
│   └── images/
├── database/
│   └── db_kju.sql
├── node_modules/
├── public/
├── tailwind.config.js
├── package.json
└── README.md
```

## 🎨 Theme

Aplikasi mendukung **Light Mode** dan **Dark Mode**. Toggle ada di navbar (top-right).

Theme preference disimpan di localStorage dan persisten.

## 🔐 Security Features

- ✅ Password hashing dengan bcrypt (PHP >= 5.5)
- ✅ Session-based authentication
- ✅ CSRF protection (CodeIgniter built-in)
- ✅ SQL Injection prevention (Prepared statements)
- ✅ XSS protection (HTML escaping)
- ✅ Role-based access control (RBAC)
- ✅ Input validation & sanitization

## 📊 Database Schema

### Tables:
1. **users** - User accounts & credentials
2. **consumers** - Customer/consumer data
3. **categories** - Product categories
4. **items** - Inventory items/products
5. **productions** - Production records
6. **cuttings** - Cutting/processing records
7. **deliveries** - Delivery/surat jalan records

### Views:
- `v_dashboard_summary` - Dashboard statistics
- `v_low_stock_alert` - Low stock items alert

## 🚀 Performance Optimization

- ✅ Database indexes pada frequently queried columns
- ✅ JOIN queries untuk reduce N+1 queries
- ✅ Pagination untuk large result sets
- ✅ Caching opportunities

## 📝 API Routes

### Auth
- `GET /auth/login` - Login page
- `POST /auth/login` - Process login
- `GET /auth/register` - Register page
- `POST /auth/register` - Process register
- `GET /auth/logout` - Logout

### Dashboard
- `GET /dashboard` - Main dashboard
- `GET /dashboard/statistics` - Statistics page

### Consumer
- `GET /consumer` - List all consumers
- `GET /consumer/add` - Add form
- `POST /consumer/add` - Create consumer
- `GET /consumer/edit/{id}` - Edit form
- `POST /consumer/edit/{id}` - Update consumer
- `GET /consumer/delete/{id}` - Delete consumer

### Category
- `GET /category` - List all categories
- `GET /category/add` - Add form
- `POST /category/add` - Create category
- `GET /category/edit/{id}` - Edit form
- `POST /category/edit/{id}` - Update category
- `GET /category/delete/{id}` - Delete category

### Item
- `GET /item` - List all items
- `GET /item/add` - Add form
- `POST /item/add` - Create item
- `GET /item/edit/{id}` - Edit form
- `POST /item/edit/{id}` - Update item
- `GET /item/delete/{id}` - Delete item
- `GET /item/get_stock/{id}` - Get stock (AJAX)

### Production
- `GET /production` - List all productions
- `GET /production/add` - Add form
- `POST /production/add` - Create production
- `GET /production/edit/{id}` - Edit form
- `POST /production/edit/{id}` - Update production
- `GET /production/delete/{id}` - Delete production

### Cutting
- `GET /cutting` - List all cuttings
- `GET /cutting/add` - Add form
- `POST /cutting/add` - Create cutting
- `GET /cutting/edit/{id}` - Edit form
- `POST /cutting/edit/{id}` - Update cutting
- `GET /cutting/delete/{id}` - Delete cutting

### Delivery
- `GET /delivery` - List all deliveries
- `GET /delivery/add` - Add form
- `POST /delivery/add` - Create delivery
- `GET /delivery/edit/{id}` - Edit form
- `POST /delivery/edit/{id}` - Update delivery
- `GET /delivery/delete/{id}` - Delete delivery
- `GET /delivery/print_surat_jalan/{id}` - Print surat jalan

### Report
- `GET /report` - Report home
- `GET /report/stock` - Stock report
- `GET /report/production` - Production report
- `GET /report/cutting` - Cutting report
- `GET /report/delivery` - Delivery report
- `GET /report/waste` - Waste/limbah report

### User Management
- `GET /user` - List all users (Admin only)
- `GET /user/add` - Add form (Admin only)
- `POST /user/add` - Create user (Admin only)
- `GET /user/edit/{id}` - Edit form (Admin only)
- `POST /user/edit/{id}` - Update user (Admin only)
- `GET /user/delete/{id}` - Delete user (Admin only)

## 🐛 Troubleshooting

### Error: Cannot connect to database
- Verifikasi username, password, dan database name di `config/database.php`
- Pastikan MySQL/MariaDB service running
- Pastikan user memiliki privilege yang tepat

### Error: 404 Not Found
- Pastikan `.htaccess` sudah dikonfigurasi dengan benar
- Check Apache `mod_rewrite` sudah enabled
- Gunakan `index.php` di URL jika masih error: `http://localhost/inventory-system/index.php/dashboard`

### Session tidak persisten
- Pastikan folder `application/cache` writable
- Check session configuration di `config/config.php`

### View tidak muncul dengan benar
- Check file permissions (`chmod 755`)
- Pastikan Tailwind CSS sudah di-build: `npm run build`
- Clear browser cache

## 📚 Additional Resources

- CodeIgniter 3 Documentation: https://codeigniter.com/user_guide/
- Tailwind CSS Documentation: https://tailwindcss.com/docs
- MySQL Documentation: https://dev.mysql.com/doc/

## 📄 License

MIT License - feel free to use this project for personal and commercial purposes.

## 👨‍💻 Author

**Smithacrh**  
GitHub: https://github.com/smithacrh

## 📞 Support

Untuk pertanyaan atau issues, silakan buka issue di GitHub repository.

---

**Last Updated:** 2026-07-14  
**Version:** 1.0.0