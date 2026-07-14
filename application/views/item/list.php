<?php if ($this->session->userdata('user_id')): ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">📦 Manajemen Stok Barang</h1>
        <a href="<?php echo base_url('item/add'); ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            ➕ Tambah Barang
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">No</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Barang</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Kategori</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Stok</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Satuan</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Harga</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php $no = 1; foreach ($items as $item): ?>
                    <tr class="border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $no++; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 font-medium"><?php echo $item->item_name; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $item->category_name; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                            <?php if ($item->stock < 10): ?>
                                <span class="bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 px-2 py-1 rounded text-xs font-bold">⚠️ <?php echo $item->stock; ?></span>
                            <?php else: ?>
                                <?php echo $item->stock; ?>
                            <?php endif; ?>
                        </td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $item->unit; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Rp <?php echo number_format($item->price, 0, ',', '.'); ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                            <a href="<?php echo base_url('item/edit/' . $item->id); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">✏️</a>
                            <a href="<?php echo base_url('item/delete/' . $item->id); ?>" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm" onclick="return confirm('Yakin ingin menghapus?');">🗑️</a>
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