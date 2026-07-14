<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
        <i class="fas fa-boxes text-blue-500"></i> Laporan Stok Barang
    </h2>

    <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900 rounded-lg">
        <p class="text-sm"><strong>Total Nilai Stok:</strong> <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">Rp <?php echo number_format($total_value, 0, ',', '.'); ?></span></p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left font-semibold">No</th>
                    <th class="px-4 py-2 text-left font-semibold">Nama Barang</th>
                    <th class="px-4 py-2 text-left font-semibold">Kategori</th>
                    <th class="px-4 py-2 text-right font-semibold">Stok</th>
                    <th class="px-4 py-2 text-right font-semibold">Harga Satuan</th>
                    <th class="px-4 py-2 text-right font-semibold">Total Nilai</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($items)): ?>
                    <?php $no = 1; foreach($items as $item): ?>
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3"><?php echo $no++; ?></td>
                            <td class="px-4 py-3 font-medium"><?php echo $item->nama_barang; ?></td>
                            <td class="px-4 py-3"><?php echo $item->nama_kategori ?? 'N/A'; ?></td>
                            <td class="px-4 py-3 text-right"><?php echo $item->stok; ?></td>
                            <td class="px-4 py-3 text-right">Rp <?php echo number_format($item->harga_satuan, 0, ',', '.'); ?></td>
                            <td class="px-4 py-3 text-right font-bold">Rp <?php echo number_format($item->total_value, 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">Belum ada data barang</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>