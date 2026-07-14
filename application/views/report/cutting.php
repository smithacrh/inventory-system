<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
        <i class="fas fa-cut text-red-500"></i> Laporan Pemotongan
    </h2>

    <!-- Filter -->
    <div class="mb-6 p-4 bg-red-50 dark:bg-red-900 rounded-lg">
        <form method="get" class="flex gap-2 items-end">
            <div>
                <label class="block text-sm font-medium mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="<?php echo $start_date; ?>" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="<?php echo $end_date; ?>" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
            </div>
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-search"></i> Filter
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left font-semibold">No</th>
                    <th class="px-4 py-2 text-left font-semibold">Barang</th>
                    <th class="px-4 py-2 text-right font-semibold">Cutting</th>
                    <th class="px-4 py-2 text-right font-semibold">Waste</th>
                    <th class="px-4 py-2 text-left font-semibold">Petugas</th>
                    <th class="px-4 py-2 text-left font-semibold">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($cuttings)): ?>
                    <?php $no = 1; foreach($cuttings as $cut): ?>
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3"><?php echo $no++; ?></td>
                            <td class="px-4 py-3 font-medium"><?php echo $cut->nama_barang; ?></td>
                            <td class="px-4 py-3 text-right"><?php echo $cut->jumlah_cutting; ?></td>
                            <td class="px-4 py-3 text-right text-red-600 dark:text-red-400 font-semibold"><?php echo $cut->jumlah_waste; ?></td>
                            <td class="px-4 py-3"><?php echo $cut->nama_lengkap ?? 'System'; ?></td>
                            <td class="px-4 py-3"><?php echo date('d M Y H:i', strtotime($cut->created_at)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">Belum ada data pemotongan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>