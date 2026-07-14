<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - Inventory System' : 'Inventory System'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        // Dark mode toggle
        function initTheme() {
            if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        }
        initTheme();
    </script>
    <style>
        [data-theme="dark"] { color-scheme: dark; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <i class="fas fa-boxes text-blue-600 dark:text-blue-400 text-2xl"></i>
                    <span class="font-bold text-xl text-gray-900 dark:text-white">Inventory System</span>
                </div>

                <!-- Menu Items -->
                <div class="hidden md:flex space-x-1">
                    <?php if($this->session->userdata('is_logged_in')): ?>
                        <a href="<?php echo base_url('dashboard'); ?>" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-chart-line"></i> Dashboard
                        </a>
                        <?php if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2): ?>
                            <a href="<?php echo base_url('consumer'); ?>" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700">
                                <i class="fas fa-users"></i> Konsumen
                            </a>
                            <a href="<?php echo base_url('item'); ?>" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700">
                                <i class="fas fa-box"></i> Barang
                            </a>
                        <?php endif; ?>
                        <?php if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2): ?>
                            <a href="<?php echo base_url('production'); ?>" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700">
                                <i class="fas fa-industry"></i> Produksi
                            </a>
                        <?php endif; ?>
                        <?php if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 3): ?>
                            <a href="<?php echo base_url('cutting'); ?>" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700">
                                <i class="fas fa-cut"></i> Pemotongan
                            </a>
                        <?php endif; ?>
                        <?php if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 4): ?>
                            <a href="<?php echo base_url('delivery'); ?>" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700">
                                <i class="fas fa-truck"></i> Pengiriman
                            </a>
                        <?php endif; ?>
                        <a href="<?php echo base_url('report'); ?>" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-file-alt"></i> Laporan
                        </a>
                        <?php if($this->session->userdata('role') == 1): ?>
                            <a href="<?php echo base_url('user'); ?>" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700">
                                <i class="fas fa-users-cog"></i> User
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <!-- Right Menu -->
                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle -->
                    <button id="themeToggle" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700" title="Toggle dark mode">
                        <i class="fas fa-moon text-yellow-500 dark:hidden"></i>
                        <i class="fas fa-sun text-yellow-300 hidden dark:block"></i>
                    </button>

                    <?php if($this->session->userdata('is_logged_in')): ?>
                        <!-- User Menu -->
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium"><?php echo $this->session->userdata('nama_lengkap'); ?></span>
                            <a href="<?php echo base_url('auth/logout'); ?>" class="px-3 py-2 bg-red-600 text-white rounded-md text-sm font-medium hover:bg-red-700">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo base_url('auth/login'); ?>" class="px-3 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                            Login
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <?php if($this->session->flashdata('success')): ?>
            <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 px-4 py-3 rounded relative">
                <i class="fas fa-check-circle"></i> <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('error')): ?>
            <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-200 px-4 py-3 rounded relative">
                <i class="fas fa-exclamation-circle"></i> <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">