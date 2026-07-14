<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
        <i class="fas fa-file-alt text-cyan-500"></i> Rekap Laporan
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="<?php echo base_url('report/stock'); ?>" class="bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg p-6 text-center transform hover:scale-105 transition">
            <i class="fas fa-boxes text-3xl mb-3"></i>
            <h3 class="text-lg font-bold">Laporan Stok</h3>
            <p class="text-sm opacity-90">Lihat semua stok barang</p>
        </a>

        <a href="<?php echo base_url('report/production'); ?>" class="bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white rounded-lg p-6 text-center transform hover:scale-105 transition">
            <i class="fas fa-industry text-3xl mb-3"></i>
            <h3 class="text-lg font-bold">Laporan Produksi</h3>
            <p class="text-sm opacity-90">Data produksi barang</p>
        </a>

        <a href="<?php echo base_url('report/cutting'); ?>" class="bg-gradient-to-br from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-lg p-6 text-center transform hover:scale-105 transition">
            <i class="fas fa-cut text-3xl mb-3"></i>
            <h3 class="text-lg font-bold">Laporan Pemotongan</h3>
            <p class="text-sm opacity-90">Data pemotongan barang</p>
        </a>

        <a href="<?php echo base_url('report/delivery'); ?>" class="bg-gradient-to-br from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white rounded-lg p-6 text-center transform hover:scale-105 transition">
            <i class="fas fa-truck text-3xl mb-3"></i>
            <h3 class="text-lg font-bold">Laporan Pengiriman</h3>
            <p class="text-sm opacity-90">Data pengiriman barang</p>
        </a>

        <a href="<?php echo base_url('report/waste'); ?>" class="bg-gradient-to-br from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white rounded-lg p-6 text-center transform hover:scale-105 transition">
            <i class="fas fa-exclamation-triangle text-3xl mb-3"></i>
            <h3 class="text-lg font-bold">Laporan Limbah</h3>
            <p class="text-sm opacity-90">Analisis waste & limbah</p>
        </a>
    </div>
</div>