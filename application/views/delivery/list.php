<?php if ($this->session->userdata('user_id')): ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">🚚 Manajemen Surat Jalan</h1>
        <a href="<?php echo base_url('delivery/add'); ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            ➕ Tambah Surat Jalan
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">No</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Konsumen</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Barang</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Qty</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Jenis</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Tanggal</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($deliveries)): ?>
                    <?php $no = 1; foreach ($deliveries as $deliv): ?>
                    <tr class="border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $no++; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $deliv->consumer_name; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $deliv->item_name; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $deliv->quantity; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                            <span class="px-2 py-1 rounded text-xs font-bold <?php echo ($deliv->delivery_type == 'Masuk') ? 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-200' : 'bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-200'; ?>">
                                <?php echo $deliv->delivery_type; ?>
                            </span>
                        </td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo date('d/m/Y H:i', strtotime($deliv->delivery_date)); ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                            <a href="<?php echo base_url('delivery/edit/' . $deliv->id); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-sm">✏️</a>
                            <a href="<?php echo base_url('delivery/print_surat_jalan/' . $deliv->id); ?>" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-sm" target="_blank">🖨️</a>
                            <a href="<?php echo base_url('delivery/delete/' . $deliv->id); ?>" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-sm" onclick="return confirm('Yakin ingin menghapus?');">🗑️</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
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