<?php if ($this->session->userdata('user_id')): ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">🏭 Laporan Produksi</h1>

    <div class="mb-6 p-4 bg-gray-100 dark:bg-gray-700 rounded">
        <form method="get" class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Dari Tanggal</label>
                <input type="date" name="start_date" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-600" value="<?php echo $start_date; ?>">
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Sampai Tanggal</label>
                <input type="date" name="end_date" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-600" value="<?php echo $end_date; ?>">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    🔍 Filter
                </button>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">No</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Barang</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Kategori</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Qty</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Tanggal</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Dibuat Oleh</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($report_data)): ?>
                    <?php $no = 1; foreach ($report_data as $item): ?>
                    <tr class="border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $no++; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 font-medium"><?php echo $item->item_name; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $item->category_name; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $item->quantity; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo date('d/m/Y H:i', strtotime($item->production_date)); ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $item->created_by_name; ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-500">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>