<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Inventory System'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <style>
        :root {
            color-scheme: light;
        }
        html.dark {
            color-scheme: dark;
        }
    </style>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-300">
    <!-- Navbar -->
    <nav class="bg-blue-600 dark:bg-blue-800 shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <h1 class="text-white font-bold text-2xl">📦 Inventory System</h1>
            </div>
            <div class="flex items-center space-x-6">
                <?php if ($this->session->userdata('user_id')): ?>
                    <span class="text-white text-sm">
                        Welcome, <strong><?php echo $this->session->userdata('user_name'); ?></strong>
                    </span>
                    <!-- Theme Toggle -->
                    <button onclick="toggleTheme()" class="bg-white dark:bg-gray-700 text-gray-900 dark:text-white px-3 py-2 rounded text-sm font-medium">
                        🌙 Dark
                    </button>
                    <a href="<?php echo base_url('auth/logout'); ?>" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm font-medium">
                        Logout
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="flex">
        <?php if ($this->session->userdata('user_id')): ?>
        <div class="w-64 bg-gray-100 dark:bg-gray-800 min-h-screen border-r border-gray-300 dark:border-gray-700">
            <div class="p-4">
                <h2 class="text-lg font-bold mb-6">Menu</h2>
                <nav class="space-y-2">
                    <a href="<?php echo base_url('dashboard'); ?>" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">📊 Dashboard</a>
                    
                    <?php if ($this->session->userdata('user_level') <= 2): ?>
                        <a href="<?php echo base_url('consumer'); ?>" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">👥 Konsumen</a>
                        <a href="<?php echo base_url('category'); ?>" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">📂 Kategori Barang</a>
                        <a href="<?php echo base_url('item'); ?>" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">📦 Stok Barang</a>
                    <?php endif; ?>
                    
                    <?php if ($this->session->userdata('user_level') <= 2): ?>
                        <a href="<?php echo base_url('production'); ?>" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">🏭 Produksi</a>
                    <?php endif; ?>
                    
                    <?php if ($this->session->userdata('user_level') <= 3): ?>
                        <a href="<?php echo base_url('cutting'); ?>" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">✂️ Pemotongan</a>
                    <?php endif; ?>
                    
                    <?php if ($this->session->userdata('user_level') <= 2): ?>
                        <a href="<?php echo base_url('delivery'); ?>" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">🚚 Surat Jalan</a>
                    <?php endif; ?>
                    
                    <?php if ($this->session->userdata('user_level') <= 2): ?>
                        <a href="<?php echo base_url('report'); ?>" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">📈 Laporan</a>
                    <?php endif; ?>
                    
                    <?php if ($this->session->userdata('user_level') == 1): ?>
                        <hr class="my-4 border-gray-300 dark:border-gray-600">
                        <a href="<?php echo base_url('user'); ?>" class="block px-4 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700">👨‍💼 User Management</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
        <?php endif; ?>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Flash Messages -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-200 rounded border border-green-400 dark:border-green-600">
                    ✅ <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($this->session->flashdata('error')): ?>
                <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 rounded border border-red-400 dark:border-red-600">
                    ❌ <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="mb-4 p-4 bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-200 rounded border border-yellow-400 dark:border-yellow-600">
                    ⚠️ <?php echo $error; ?>
                </div>
            <?php endif; ?>