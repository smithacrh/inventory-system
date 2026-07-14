<?php if ($this->session->userdata('user_id')): ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">Statistik</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Production Stats -->
        <div class="border border-gray-300 dark:border-gray-600 p-4 rounded">
            <h2 class="text-lg font-bold mb-4">📊 Statistik Produksi (30 Hari Terakhir)</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Total</th>
                            <th class="px-4 py-2 text-left">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($production_stats)): ?>
                            <?php foreach ($production_stats as $stat): ?>
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2"><?php echo date('d/m/Y', strtotime($stat->date)); ?></td>
                                <td class="px-4 py-2"><?php echo $stat->total_production; ?></td>
                                <td class="px-4 py-2"><?php echo $stat->total_quantity; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-center text-gray-500">Belum ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Delivery Stats -->
        <div class="border border-gray-300 dark:border-gray-600 p-4 rounded">
            <h2 class="text-lg font-bold mb-4">🚚 Statistik Pengiriman (30 Hari Terakhir)</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left">Tanggal</th>
                            <th class="px-4 py-2 text-left">Total</th>
                            <th class="px-4 py-2 text-left">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($delivery_stats)): ?>
                            <?php foreach ($delivery_stats as $stat): ?>
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2"><?php echo date('d/m/Y', strtotime($stat->date)); ?></td>
                                <td class="px-4 py-2"><?php echo $stat->total_delivery; ?></td>
                                <td class="px-4 py-2"><?php echo $stat->total_quantity; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-center text-gray-500">Belum ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>