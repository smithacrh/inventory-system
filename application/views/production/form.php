<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
        <?php echo isset($production) ? '<i class="fas fa-edit text-yellow-500"></i> Edit Produksi' : '<i class="fas fa-plus text-orange-500"></i> Tambah Produksi'; ?>
    </h2>

    <form method="post" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Barang</label>
            <select name="item_id" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-orange-500">
                <option value="">Pilih Barang</option>
                <?php foreach($items as $item): ?>
                    <option value="<?php echo $item->id; ?>" <?php echo isset($production) && $production->item_id == $item->id ? 'selected' : ''; ?>><?php echo $item->nama_barang; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jumlah Produksi</label>
            <input type="number" name="jumlah" required value="<?php echo isset($production) ? $production->jumlah_produksi : ''; ?>" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-orange-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Catatan</label>
            <textarea name="catatan" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-orange-500"><?php echo isset($production) ? $production->catatan : ''; ?></textarea>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-lg">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="<?php echo base_url('production'); ?>" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg text-center">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>