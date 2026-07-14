<?php if ($this->session->userdata('user_id')): ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">📦 Laporan Stok Barang</h1>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">No</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Barang</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Kategori</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Stok</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Unit</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Harga</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Total Value</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($report_data)): ?>
                    <?php $no = 1; $total = 0; foreach ($report_data as $item): ?>
                    <tr class="border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $no++; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 font-medium"><?php echo $item->item_name; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $item->category_name; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $item->stock; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $item->unit; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Rp <?php echo number_format($item->price, 0, ',', '.'); ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Rp <?php echo number_format($item->total_value, 0, ',', '.'); ?></td>
                    </tr>
                    <?php $total += $item->total_value; ?>
                    <?php endforeach; ?>
                    <tr class="bg-gray-200 dark:bg-gray-700 font-bold">
                        <td colspan="6" class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-right">TOTAL VALUE</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-500">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>