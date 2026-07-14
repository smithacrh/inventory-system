<?php if ($this->session->userdata('user_id')): ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow max-w-2xl">
    <h1 class="text-2xl font-bold mb-6"><?php echo $title; ?></h1>

    <?php if (validation_errors()): ?>
        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 rounded">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($delivery)): ?>
        <?php $form_action = base_url('delivery/edit/' . $delivery->id); ?>
    <?php else: ?>
        <?php $form_action = base_url('delivery/add'); ?>
    <?php endif; ?>

    <form method="post" action="<?php echo $form_action; ?>" class="space-y-4">
        <div>
            <label class="block text-sm font-medium mb-2">Konsumen</label>
            <select name="consumer_id" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" required>
                <option value="">-- Pilih Konsumen --</option>
                <?php foreach ($consumers as $consumer): ?>
                    <option value="<?php echo $consumer->id; ?>" <?php echo (isset($delivery) && $delivery->consumer_id == $consumer->id) ? 'selected' : ''; ?>>
                        <?php echo $consumer->name; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Barang</label>
            <select name="item_id" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" required>
                <option value="">-- Pilih Barang --</option>
                <?php foreach ($items as $item): ?>
                    <option value="<?php echo $item->id; ?>" <?php echo (isset($delivery) && $delivery->item_id == $item->id) ? 'selected' : ''; ?>>
                        <?php echo $item->item_name; ?> (Stok: <?php echo $item->stock; ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Jumlah</label>
                <input type="number" name="quantity" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" 
                    value="<?php echo isset($delivery) ? $delivery->quantity : set_value('quantity'); ?>" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Jenis Pengiriman</label>
                <select name="delivery_type" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" required>
                    <option value="">-- Pilih --</option>
                    <option value="Masuk" <?php echo (isset($delivery) && $delivery->delivery_type == 'Masuk') ? 'selected' : ''; ?>>Masuk</option>
                    <option value="Keluar" <?php echo (isset($delivery) && $delivery->delivery_type == 'Keluar') ? 'selected' : ''; ?>>Keluar</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Tanggal Pengiriman</label>
            <input type="datetime-local" name="delivery_date" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" 
                value="<?php echo isset($delivery) ? date('Y-m-d\TH:i', strtotime($delivery->delivery_date)) : date('Y-m-d\TH:i'); ?>" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Catatan</label>
            <textarea name="notes" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" rows="4"><?php echo isset($delivery) ? $delivery->notes : set_value('notes'); ?></textarea>
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                💾 Simpan
            </button>
            <a href="<?php echo base_url('delivery'); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">
                ❌ Batal
            </a>
        </div>
    </form>
</div>
<?php endif; ?>