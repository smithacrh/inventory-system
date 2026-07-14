# Inventory Management System - Setup Guide

## 📋 Persyaratan

- Apache Web Server
- PHP 7.4.23 atau lebih tinggi
- MySQL/MariaDB 5.7 atau lebih tinggi
- Composer (opsional)
- Node.js & npm (untuk Tailwind CSS)

## 🚀 Instalasi

### 1. Persiapan Direktori

```bash
# Clone repository
git clone https://github.com/smithacrh/inventory-system.git
cd inventory-system

# Buat direktori yang diperlukan
mkdir -p application/logs
mkdir -p application/cache

# Set permissions (Linux/Mac)
chmod -R 755 application/
chmod -R 755 system/
chmod 644 .htaccess
```

### 2. Konfigurasi Database

#### MySQL/MariaDB

```sql
-- Login ke MySQL
mysql -u root -p

-- Buat database
CREATE DATABASE db_kju CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Import schema
USE db_kju;
SOURCE database/db_kju.sql;
```

### 3. Konfigurasi CodeIgniter

Edit file `application/config/database.php`:

```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',           // Ganti dengan username MySQL Anda
    'password' => '',               // Ganti dengan password MySQL Anda
    'database' => 'db_kju',
    'dbdriver' => 'mysqli',
    // ... konfigurasi lainnya
);
```

Edit file `application/config/config.php`:

```php
$config['base_url'] = 'http://localhost/inventory-system/';
```

### 4. Install Dependencies

```bash
# Install npm packages
npm install

# Build Tailwind CSS (development)
npm run dev

# Build Tailwind CSS (production - minified)
npm run build
```

### 5. Setup Virtual Host (Optional)

#### Apache vhost.conf

```apache
<VirtualHost *:80>
    ServerName inventory.local
    ServerAlias www.inventory.local
    DocumentRoot /path/to/inventory-system

    <Directory /path/to/inventory-system>
        Options +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/inventory-error.log
    CustomLog ${APACHE_LOG_DIR}/inventory-access.log combined
</VirtualHost>
```

Tambahkan ke `/etc/hosts` (Linux/Mac):
```
127.0.0.1 inventory.local
```

Ou `C:\Windows\System32\drivers\etc\hosts` (Windows):
```
127.0.0.1 inventory.local
```

### 6. Akses Aplikasi

```
http://localhost/inventory-system
or
http://inventory.local
```

## 👥 Akun Demo

Setelah import database, gunakan akun berikut untuk login:

| Role | Username | Password |
|------|----------|----------|
| Admin | admin | password |
| Operator Assembly | operator_assembly | password |
| Operator Cutting | operator_cutting | password |
| Driver | driver | password |

> **⚠️ PENTING**: Ubah password semua akun di production!

## 🔐 Security

### Tips Keamanan

1. **Change Default Password**
   ```php
   // Di Admin > Manajemen User
   ```

2. **Update Config**
   ```php
   // application/config/config.php
   $config['encryption_key'] = 'your-secret-key-here';
   ```

3. **SSL/HTTPS**
   - Gunakan HTTPS di production
   - Update `base_url` dengan https://

4. **Database Backup**
   ```bash
   mysqldump -u root -p db_kju > backup_$(date +%Y%m%d_%H%M%S).sql
   ```

## 📁 Struktur Direktori

```
inventory-system/
├── application/
│   ├── config/           # Konfigurasi aplikasi
│   ├── controllers/      # Controller
│   ├── models/          # Database models
│   ├── views/           # View templates
│   ├── helpers/         # Helper functions
│   ├── logs/            # Log files
│   └── cache/           # Cache files
├── assets/
│   ├── css/             # Stylesheet
│   ├── js/              # JavaScript files
│   └── images/          # Image assets
├── database/            # Database schema
├── system/              # CodeIgniter system files
├── .gitignore          # Git ignore file
├── .htaccess           # Apache rewrite rules
├── tailwind.config.js  # Tailwind configuration
├── package.json        # NPM dependencies
└── README.md           # This file
```

## 🎨 Fitur

### User Roles

- **Admin** - Full access to all features
- **Operator Assembly** - Create production records, manage stock
- **Operator Cutting** - Create cutting records
- **Driver** - Create and manage delivery letters

### Menu & Features

#### Admin
- Dashboard
- Manajemen Konsumen
- Manajemen Kategori Barang
- Manajemen Stok Barang
- Tambah Stok Barang
- Produksi Barang
- Produksi Cutting
- Surat Jalan
- Rekap Laporan
- Manajemen User

#### Operator Assembly
- Dashboard
- Stok Barang
- Tambah Stok
- Produksi Barang
- Rekap Stok
- Rekap Produksi
- Rekap Sampah

#### Operator Cutting
- Dashboard
- Produksi Cutting
- Rekap Sampah

#### Driver
- Dashboard
- Surat Jalan
- Rekap Surat Jalan

## 🌙 Dark Mode

Aplikasi mendukung light mode dan dark mode. Toggle tersedia di navbar.

Preferensi disimpan di `localStorage`.

## 📱 Responsive Design

Aplikasi responsif dan bisa diakses dari:
- Desktop
- Tablet
- Mobile

## 🛠 Troubleshooting

### Problem: 404 Not Found

**Solusi:**
1. Pastikan `.htaccess` ada di root directory
2. Enable Apache `mod_rewrite`:
   ```bash
   sudo a2enmod rewrite
   sudo systemctl restart apache2
   ```
3. Update `base_url` di `config.php`

### Problem: Database Connection Error

**Solusi:**
1. Check MySQL running
2. Verify credentials di `database.php`
3. Check database exists
4. Check PHP MySQL extension enabled

### Problem: Cannot Upload Files

**Solusi:**
1. Check folder permissions (755)
2. Check disk space
3. Verify `upload_max_filesize` di php.ini

### Problem: Tailwind CSS not working

**Solusi:**
```bash
# Rebuild CSS
npm run build

# Or watch for changes
npm run dev
```

## 📝 Troubleshooting Log

Cek error di:
- `application/logs/log-*.php`
- Browser DevTools Console (F12)
- Apache error log

## 🤝 Support

Untuk pertanyaan atau masalah:
1. Check documentation
2. Review application logs
3. Check GitHub issues
4. Contact developer

## 📄 License

MIT License - See LICENSE file

---

**Dibuat oleh:** Smitharch  
**Version:** 1.0.0  
**Last Updated:** 2026-07-14
