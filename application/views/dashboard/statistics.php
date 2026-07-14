<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <p class="text-gray-500 dark:text-gray-400 text-sm">Total Konsumen</p>
        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400"><?php echo $total_consumers; ?></p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <p class="text-gray-500 dark:text-gray-400 text-sm">Total Barang</p>
        <p class="text-3xl font-bold text-green-600 dark:text-green-400"><?php echo $total_items; ?></p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <p class="text-gray-500 dark:text-gray-400 text-sm">Total Produksi</p>
        <p class="text-3xl font-bold text-orange-600 dark:text-orange-400"><?php echo $total_productions; ?></p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <p class="text-gray-500 dark:text-gray-400 text-sm">Nilai Stok Total</p>
        <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">Rp <?php echo number_format($total_stock_value, 0, ',', '.'); ?></p>
    </div>
</div>