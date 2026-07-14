<?php if ($this->session->userdata('user_id')): ?>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <!-- Total Konsumen -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Konsumen</p>
                <p class="text-3xl font-bold mt-2"><?php echo $total_consumers; ?></p>
            </div>
            <div class="text-4xl">👥</div>
        </div>
    </div>

    <!-- Total Barang -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Barang</p>
                <p class="text-3xl font-bold mt-2"><?php echo $total_items; ?></p>
            </div>
            <div class="text-4xl">📦</div>
        </div>
    </div>

    <!-- Total Produksi -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Produksi</p>
                <p class="text-3xl font-bold mt-2"><?php echo $total_production; ?></p>
            </div>
            <div class="text-4xl">🏭</div>
        </div>
    </div>

    <!-- Total Pengiriman -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-l-4 border-red-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">Total Pengiriman</p>
                <p class="text-3xl font-bold mt-2"><?php echo $total_delivery; ?></p>
            </div>
            <div class="text-4xl">🚚</div>
        </div>
    </div>
</div>

<!-- Recent Production & Delivery -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Recent Productions -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-lg font-bold mb-4">📊 Produksi Terbaru</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Barang</th>
                        <th class="px-4 py-2 text-left">Qty</th>
                        <th class="px-4 py-2 text-left">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recent_productions)): ?>
                        <?php foreach ($recent_productions as $prod): ?>
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-2"><?php echo $prod->item_name; ?></td>
                            <td class="px-4 py-2"><?php echo $prod->quantity; ?></td>
                            <td class="px-4 py-2"><?php echo date('d/m/Y', strtotime($prod->production_date)); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center text-gray-500">Belum ada produksi</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Deliveries -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-lg font-bold mb-4">🚚 Pengiriman Terbaru</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Konsumen</th>
                        <th class="px-4 py-2 text-left">Qty</th>
                        <th class="px-4 py-2 text-left">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recent_deliveries)): ?>
                        <?php foreach ($recent_deliveries as $deliv): ?>
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-2"><?php echo $deliv->consumer_name; ?></td>
                            <td class="px-4 py-2"><?php echo $deliv->quantity; ?></td>
                            <td class="px-4 py-2"><?php echo date('d/m/Y', strtotime($deliv->delivery_date)); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="px-4 py-2 text-center text-gray-500">Belum ada pengiriman</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Stock Summary -->
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h2 class="text-lg font-bold mb-4">📦 Ringkasan Stok</h2>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Barang</th>
                    <th class="px-4 py-2 text-left">Kategori</th>
                    <th class="px-4 py-2 text-left">Stok</th>
                    <th class="px-4 py-2 text-left">Satuan</th>
                    <th class="px-4 py-2 text-left">Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($stock_summary)): ?>
                    <?php foreach ($stock_summary as $item): ?>
                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-2"><?php echo $item->item_name; ?></td>
                        <td class="px-4 py-2"><?php echo $item->category_name; ?></td>
                        <td class="px-4 py-2">
                            <?php if ($item->stock < 10): ?>
                                <span class="bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 px-2 py-1 rounded text-xs font-bold"><?php echo $item->stock; ?></span>
                            <?php else: ?>
                                <span><?php echo $item->stock; ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-2"><?php echo $item->unit; ?></td>
                        <td class="px-4 py-2">Rp <?php echo number_format($item->price, 0, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-gray-500">Belum ada barang</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php else: ?>
    <div class="text-center">
        <p class="text-gray-600">Silakan login terlebih dahulu</p>
    </div>
<?php endif; ?>