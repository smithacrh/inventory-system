<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 max-w-2xl mx-auto">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
        <i class="fas fa-plus-circle text-blue-600 mr-2"></i> Tambah Stok Barang
    </h3>

    <form id="addStockForm" class="space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Barang</label>
            <select name="item_id" id="itemSelect" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Barang --</option>
                <?php if(!empty($items)): ?>
                    <?php foreach($items as $item): ?>
                        <option value="<?= $item->id ?>">[
<?= $item->category_name ?>
] <?= $item->name ?> (Stok: <?= $item->stock ?>)</option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jumlah Stok yang Ditambahkan</label>
            <input type="number" name="quantity" id="quantityInput" min="1" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan jumlah">
        </div>

        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-md p-4">
            <p class="text-sm text-blue-800 dark:text-blue-200">
                <i class="fas fa-info-circle mr-2"></i>
                Masukkan jumlah stok yang ingin ditambahkan. Stok akan langsung terupdate di sistem.
            </p>
        </div>

        <div class="flex gap-3 justify-end">
            <a href="<?= base_url('item') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check mr-2"></i> Simpan Stok
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('addStockForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '<?= base_url('item/save_stock') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showSuccess(response.message);
                    setTimeout(() => {
                        window.location.href = '<?= base_url('item') ?>';
                    }, 1500);
                } else {
                    showError(response.message);
                }
            }
        });
    });
</script>
