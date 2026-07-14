<?php
define('APP_NAME', 'KJU Inventory System');
define('APP_VERSION', '1.0.0');
define('APP_AUTHOR', 'Smitharch');
define('APP_YEAR', date('Y'));

// Database Settings
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_kju');

// File Upload Settings
define('UPLOAD_PATH', './uploads/');
define('UPLOAD_ALLOWED_TYPES', 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx');
define('UPLOAD_MAX_SIZE', '5000'); // KB

// Date Format
define('DATE_FORMAT', 'd-m-Y');
define('DATETIME_FORMAT', 'd-m-Y H:i:s');
define('DATE_FORMAT_DB', 'Y-m-d');
define('DATETIME_FORMAT_DB', 'Y-m-d H:i:s');

// Pagination
define('ITEMS_PER_PAGE', 25);
define('PAGINATION_NUM_LINKS', 5);

// Messages
define('MSG_SUCCESS_ADD', 'Data berhasil ditambahkan');
define('MSG_SUCCESS_UPDATE', 'Data berhasil diperbarui');
define('MSG_SUCCESS_DELETE', 'Data berhasil dihapus');
define('MSG_ERROR_ADD', 'Gagal menambahkan data');
define('MSG_ERROR_UPDATE', 'Gagal memperbarui data');
define('MSG_ERROR_DELETE', 'Gagal menghapus data');
define('MSG_ERROR_NOT_FOUND', 'Data tidak ditemukan');
define('MSG_ERROR_VALIDATION', 'Validasi gagal');
define('MSG_UNAUTHORIZED', 'Anda tidak memiliki akses ke halaman ini');
