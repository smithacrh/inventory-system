<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
        <?php echo isset($consumer) ? '<i class="fas fa-edit text-yellow-500"></i> Edit Konsumen' : '<i class="fas fa-plus text-blue-500"></i> Tambah Konsumen'; ?>
    </h2>

    <form method="post" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Konsumen</label>
            <input type="text" name="nama_konsumen" required value="<?php echo isset($consumer) ? $consumer->nama_konsumen : ''; ?>" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
            <textarea name="alamat" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-blue-500"><?php echo isset($consumer) ? $consumer->alamat : ''; ?></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Telepon</label>
            <input type="tel" name="telepon" required value="<?php echo isset($consumer) ? $consumer->telepon : ''; ?>" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
            <input type="email" name="email" value="<?php echo isset($consumer) ? $consumer->email : ''; ?>" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-blue-500">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="<?php echo base_url('consumer'); ?>" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg text-center">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>