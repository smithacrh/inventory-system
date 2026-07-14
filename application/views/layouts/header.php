<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title . ' - ' : '' ?>Inventory System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        // Theme Toggle
        function toggleTheme() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }

        // Load saved theme
        document.addEventListener('DOMContentLoaded', function() {
            const theme = localStorage.getItem('theme') || 'light';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        });
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="w-64 bg-blue-600 dark:bg-blue-900 text-white overflow-y-auto fixed md:relative z-40 h-full transform -translate-x-full md:translate-x-0 transition-transform duration-300">
            <div class="p-6 border-b border-blue-700">
                <h1 class="text-2xl font-bold">📦 KJU Inventory</h1>
                <p class="text-blue-100 text-sm mt-1">Sistem Manajemen Inventory</p>
            </div>

            <nav class="p-4 space-y-2">
                <!-- Dashboard -->
                <a href="<?= base_url('dashboard') ?>" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                    <i class="fas fa-chart-line w-5 mr-3"></i> Dashboard
                </a>

                <?php if (in_array($this->session->userdata('level'), array(1))): ?>
                    <!-- Konsumen -->
                    <a href="<?= base_url('consumer') ?>" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                        <i class="fas fa-users w-5 mr-3"></i> Konsumen
                    </a>

                    <!-- Kategori Barang -->
                    <a href="<?= base_url('item_category') ?>" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                        <i class="fas fa-tags w-5 mr-3"></i> Kategori Barang
                    </a>
                <?php endif; ?>

                <?php if (in_array($this->session->userdata('level'), array(1, 2))): ?>
                    <!-- Stok Barang -->
                    <a href="<?= base_url('item') ?>" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                        <i class="fas fa-boxes w-5 mr-3"></i> Stok Barang
                    </a>

                    <!-- Tambah Stok -->
                    <a href="<?= base_url('item/add_stock') ?>" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                        <i class="fas fa-plus-circle w-5 mr-3"></i> Tambah Stok
                    </a>

                    <!-- Produksi Barang -->
                    <a href="<?= base_url('production') ?>" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                        <i class="fas fa-industry w-5 mr-3"></i> Produksi Barang
                    </a>
                <?php endif; ?>

                <?php if (in_array($this->session->userdata('level'), array(1, 3))): ?>
                    <!-- Produksi Cutting -->
                    <a href="<?= base_url('cutting') ?>" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                        <i class="fas fa-cut w-5 mr-3"></i> Produksi Cutting
                    </a>
                <?php endif; ?>

                <?php if (in_array($this->session->userdata('level'), array(1, 4))): ?>
                    <!-- Surat Jalan -->
                    <a href="<?= base_url('delivery') ?>" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                        <i class="fas fa-file-alt w-5 mr-3"></i> Surat Jalan
                    </a>
                <?php endif; ?>

                <?php if (in_array($this->session->userdata('level'), array(1, 2, 3))): ?>
                    <!-- Sampah Produksi -->
                    <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                        <i class="fas fa-trash w-5 mr-3"></i> Sampah Produksi
                    </a>
                <?php endif; ?>

                <!-- Rekap -->
                <div class="px-4 py-2 text-blue-100 text-sm font-semibold mt-4">LAPORAN</div>

                <?php if (in_array($this->session->userdata('level'), array(1, 2))): ?>
                    <a href="<?= base_url('report/stock_recap') ?>" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                        <i class="fas fa-receipt w-5 mr-3"></i> Rekap Stok
                    </a>
                    <a href="<?= base_url('report/production_recap') ?>" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                        <i class="fas fa-chart-bar w-5 mr-3"></i> Rekap Produksi
                    </a>
                <?php endif; ?>

                <?php if (in_array($this->session->userdata('level'), array(1, 2, 3))): ?>
                    <a href="<?= base_url('report/waste_recap') ?>" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                        <i class="fas fa-trash-alt w-5 mr-3"></i> Rekap Sampah
                    </a>
                <?php endif; ?>

                <?php if (in_array($this->session->userdata('level'), array(1, 4))): ?>
                    <a href="<?= base_url('report/delivery_recap') ?>" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                        <i class="fas fa-shipping-fast w-5 mr-3"></i> Rekap Surat Jalan
                    </a>
                <?php endif; ?>

                <?php if (in_array($this->session->userdata('level'), array(1))): ?>
                    <!-- User Management -->
                    <div class="px-4 py-2 text-blue-100 text-sm font-semibold mt-4">ADMIN</div>
                    <a href="<?= base_url('user') ?>" class="flex items-center px-4 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">
                        <i class="fas fa-user-cog w-5 mr-3"></i> Manajemen User
                    </a>
                <?php endif; ?>

                <!-- Logout -->
                <button onclick="logout()" class="w-full flex items-center px-4 py-3 rounded-lg hover:bg-red-600 dark:hover:bg-red-700 transition mt-4 text-left">
                    <i class="fas fa-sign-out-alt w-5 mr-3"></i> Logout
                </button>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button id="sidebarToggle" class="md:hidden p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2 class="text-2xl font-bold"><?= isset($page_title) ? $page_title : 'Dashboard' ?></h2>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Theme Toggle -->
                    <button onclick="toggleTheme()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                        <i class="fas fa-moon dark:hidden"></i>
                        <i class="fas fa-sun hidden dark:inline"></i>
                    </button>

                    <!-- User Profile -->
                    <div class="flex items-center gap-2 text-sm">
                        <div class="text-right">
                            <p class="font-semibold"><?= $this->session->userdata('username') ?></p>
                            <p class="text-gray-500 dark:text-gray-400 text-xs"><?= isset(ROLE_NAMES[$this->session->userdata('level')]) ? ROLE_NAMES[$this->session->userdata('level')] : 'User' ?></p>
                        </div>
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                            <?= substr($this->session->userdata('username'), 0, 1) ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto p-6">
