<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Total Konsumen</p>
                <p class="text-3xl font-bold text-blue-600 dark:text-blue-400"><?php echo $total_consumers; ?></p>
            </div>
            <i class="fas fa-users text-blue-600 dark:text-blue-400 text-4xl opacity-20"></i>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Total Barang</p>
                <p class="text-3xl font-bold text-green-600 dark:text-green-400"><?php echo $total_items; ?></p>
            </div>
            <i class="fas fa-box text-green-600 dark:text-green-400 text-4xl opacity-20"></i>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Total Produksi</p>
                <p class="text-3xl font-bold text-orange-600 dark:text-orange-400"><?php echo $total_productions; ?></p>
            </div>
            <i class="fas fa-industry text-orange-600 dark:text-orange-400 text-4xl opacity-20"></i>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 hover:shadow-lg transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Total Pengiriman</p>
                <p class="text-3xl font-bold text-red-600 dark:text-red-400"><?php echo $total_deliveries; ?></p>
            </div>
            <i class="fas fa-truck text-red-600 dark:text-red-400 text-4xl opacity-20"></i>
        </div>
    </div>
</div>

<!-- Recent Activities -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Productions -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
            <i class="fas fa-industry text-orange-500"></i> Produksi Terakhir
        </h3>
        <div class="space-y-3">
            <?php if(!empty($recent_productions)): ?>
                <?php foreach($recent_productions as $prod): ?>
                    <div class="flex justify-between items-center p-3 border-l-4 border-orange-500 bg-gray-50 dark:bg-gray-700">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white"><?php echo $prod->nama_barang; ?></p>
                            <p class="text-sm text-gray-500 dark:text-gray-400"><?php echo date('d M Y H:i', strtotime($prod->created_at)); ?></p>
                        </div>
                        <span class="bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200 px-3 py-1 rounded-full text-sm font-medium">
                            +<?php echo $prod->jumlah_produksi; ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-500 dark:text-gray-400">Belum ada data produksi</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Deliveries -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
            <i class="fas fa-truck text-red-500"></i> Pengiriman Terakhir
        </h3>
        <div class="space-y-3">
            <?php if(!empty($recent_deliveries)): ?>
                <?php foreach($recent_deliveries as $deliv): ?>
                    <div class="flex justify-between items-center p-3 border-l-4 border-red-500 bg-gray-50 dark:bg-gray-700">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white"><?php echo $deliv->nama_barang; ?></p>
                            <p class="text-sm text-gray-500 dark:text-gray-400"><?php echo date('d M Y H:i', strtotime($deliv->created_at)); ?></p>
                        </div>
                        <span class="bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 px-3 py-1 rounded-full text-sm font-medium">
                            -<?php echo $deliv->jumlah_pengiriman; ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-500 dark:text-gray-400">Belum ada data pengiriman</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Stock Summary -->
<div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
        <i class="fas fa-boxes text-blue-500"></i> Ringkasan Stok
    </h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left font-semibold">Nama Barang</th>
                    <th class="px-4 py-2 text-right font-semibold">Stok</th>
                    <th class="px-4 py-2 text-right font-semibold">Min. Stok</th>
                    <th class="px-4 py-2 text-center font-semibold">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($stock_summary)): ?>
                    <?php foreach(array_slice($stock_summary, 0, 10) as $item): ?>
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3"><?php echo $item->nama_barang; ?></td>
                            <td class="px-4 py-3 text-right font-medium"><?php echo $item->stok; ?></td>
                            <td class="px-4 py-3 text-right"><?php echo $item->minimum_stok; ?></td>
                            <td class="px-4 py-3 text-center">
                                <?php if($item->stok <= $item->minimum_stok): ?>
                                    <span class="bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 px-2 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-exclamation-triangle"></i> Rendah
                                    </span>
                                <?php else: ?>
                                    <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-2 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-check-circle"></i> Normal
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">Belum ada data barang</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>