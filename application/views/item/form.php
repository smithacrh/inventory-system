<?php if ($this->session->userdata('user_id')): ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow max-w-2xl">
    <h1 class="text-2xl font-bold mb-6"><?php echo $title; ?></h1>

    <?php if (validation_errors()): ?>
        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 rounded">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($item)): ?>
        <?php $form_action = base_url('item/edit/' . $item->id); ?>
    <?php else: ?>
        <?php $form_action = base_url('item/add'); ?>
    <?php endif; ?>

    <form method="post" action="<?php echo $form_action; ?>" class="space-y-4">
        <div>
            <label class="block text-sm font-medium mb-2">Nama Barang</label>
            <input type="text" name="item_name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" 
                value="<?php echo isset($item) ? $item->item_name : set_value('item_name'); ?>" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Kategori</label>
            <select name="category_id" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat->id; ?>" <?php echo (isset($item) && $item->category_id == $cat->id) ? 'selected' : ''; ?>>
                        <?php echo $cat->category_name; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Stok</label>
                <input type="number" name="stock" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" 
                    value="<?php echo isset($item) ? $item->stock : set_value('stock'); ?>" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Satuan</label>
                <input type="text" name="unit" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" 
                    value="<?php echo isset($item) ? $item->unit : set_value('unit'); ?>" placeholder="pcs, meter, kg, liter" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Harga</label>
            <input type="number" name="price" step="0.01" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" 
                value="<?php echo isset($item) ? $item->price : set_value('price'); ?>" required>
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                💾 Simpan
            </button>
            <a href="<?php echo base_url('item'); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">
                ❌ Batal
            </a>
        </div>
    </form>
</div>
<?php endif; ?>