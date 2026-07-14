<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
        <?php echo isset($item) ? '<i class="fas fa-edit text-yellow-500"></i> Edit Barang' : '<i class="fas fa-plus text-purple-500"></i> Tambah Barang'; ?>
    </h2>

    <form method="post" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori</label>
            <select name="kategori_id" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-purple-500">
                <option value="">Pilih Kategori</option>
                <?php foreach($categories as $cat): ?>
                    <option value="<?php echo $cat->id; ?>" <?php echo isset($item) && $item->kategori_id == $cat->id ? 'selected' : ''; ?>><?php echo $cat->nama_kategori; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Barang</label>
            <input type="text" name="nama_barang" required value="<?php echo isset($item) ? $item->nama_barang : ''; ?>" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-purple-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">SKU</label>
            <input type="text" name="sku" required value="<?php echo isset($item) ? $item->sku : ''; ?>" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-purple-500">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga Satuan</label>
                <input type="number" name="harga_satuan" required value="<?php echo isset($item) ? $item->harga_satuan : ''; ?>" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Satuan</label>
                <input type="text" name="satuan" required value="<?php echo isset($item) ? $item->satuan : ''; ?>" placeholder="Pcs, Kg, Ltr" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-purple-500">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stok</label>
                <input type="number" name="stok" required value="<?php echo isset($item) ? $item->stok : ''; ?>" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Minimum Stok</label>
                <input type="number" name="minimum_stok" required value="<?php echo isset($item) ? $item->minimum_stok : ''; ?>" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-purple-500">
            </div>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="<?php echo base_url('item'); ?>" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg text-center">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>