# Inventory Management System

Sistem manajemen inventory perusahaan berbasis web menggunakan CodeIgniter 3 dan Tailwind CSS dengan theme toggle light/dark.

## 📋 Requirements

- PHP 7.4.23
- CodeIgniter 3
- Tailwind CSS
- MySQL/MariaDB
- Apache/Nginx

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

Import file `database/db_kju.sql`

### 3. Configure CodeIgniter
- Edit `application/config/database.php`
- Sesuaikan `$db['default']` dengan kredensial database Anda

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
```

## 👥 User Roles

- **Level 1**: Admin (Full Access)
- **Level 2**: Operator Assembly
- **Level 3**: Operator Cutting
- **Level 4**: Driver

## 📱 Features

- ✅ Login/Logout dengan role-based access
- ✅ Dashboard dengan statistik
- ✅ Manajemen Konsumen
- ✅ Manajemen Kategori Barang
- ✅ Manajemen Stok Barang
- ✅ Produksi Barang & Cutting
- ✅ Surat Jalan (Masuk/Keluar)
- ✅ Rekap Laporan
- ✅ User Management
- ✅ Dark/Light Theme
- ✅ Responsive Design

## 📁 Folder Structure

```
inventory-system/
├── application/
│   ├── controllers/
│   ├── models/
│   ├── views/
│   ├── config/
│   └── ...
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── database/
│   └── db_kju.sql
├── node_modules/
├── public/
└── tailwind.config.js
```

## 🎨 Theme

Aplikasi mendukung **Light Mode** dan **Dark Mode**. Toggle ada di navbar.

## 📄 License

MIT License

