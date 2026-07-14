<?php if ($this->session->userdata('user_id')): ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow max-w-2xl">
    <h1 class="text-2xl font-bold mb-6"><?php echo $title; ?></h1>

    <?php if (validation_errors()): ?>
        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 rounded">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($category)): ?>
        <?php $form_action = base_url('category/edit/' . $category->id); ?>
    <?php else: ?>
        <?php $form_action = base_url('category/add'); ?>
    <?php endif; ?>

    <form method="post" action="<?php echo $form_action; ?>" class="space-y-4">
        <div>
            <label class="block text-sm font-medium mb-2">Nama Kategori</label>
            <input type="text" name="category_name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" 
                value="<?php echo isset($category) ? $category->category_name : set_value('category_name'); ?>" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Deskripsi</label>
            <textarea name="description" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" rows="4"><?php echo isset($category) ? $category->description : set_value('description'); ?></textarea>
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                💾 Simpan
            </button>
            <a href="<?php echo base_url('category'); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">
                ❌ Batal
            </a>
        </div>
    </form>
</div>
<?php endif; ?>