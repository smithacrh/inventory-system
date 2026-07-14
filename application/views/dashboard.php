<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Total Stok -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Total Stok</p>
                <p class="text-3xl font-bold text-blue-600 dark:text-blue-400"><?= $total_stock ?? 0 ?></p>
            </div>
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                <i class="fas fa-boxes text-2xl text-blue-600 dark:text-blue-400"></i>
            </div>
        </div>
    </div>

    <!-- Total Items -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Total Barang</p>
                <p class="text-3xl font-bold text-green-600 dark:text-green-400"><?= $total_items ?? 0 ?></p>
            </div>
            <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                <i class="fas fa-cube text-2xl text-green-600 dark:text-green-400"></i>
            </div>
        </div>
    </div>

    <!-- Produksi Hari Ini -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Produksi Hari Ini</p>
                <p class="text-3xl font-bold text-orange-600 dark:text-orange-400"><?= $production_count ?? 0 ?></p>
            </div>
            <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center">
                <i class="fas fa-industry text-2xl text-orange-600 dark:text-orange-400"></i>
            </div>
        </div>
    </div>

    <!-- Cutting Hari Ini -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Cutting Hari Ini</p>
                <p class="text-3xl font-bold text-red-600 dark:text-red-400"><?= $cutting_count ?? 0 ?></p>
            </div>
            <div class="w-12 h-12 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center">
                <i class="fas fa-cut text-2xl text-red-600 dark:text-red-400"></i>
            </div>
        </div>
    </div>
</div>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Selamat datang, <?= $this->session->userdata('username') ?>! 👋</h3>
    <p class="text-gray-600 dark:text-gray-400">Anda login sebagai <strong><?= isset(ROLE_NAMES[$this->session->userdata('level')]) ? ROLE_NAMES[$this->session->userdata('level')] : 'User' ?></strong>. Gunakan menu di sidebar untuk mengakses fitur-fitur sistem.</p>
</div>
