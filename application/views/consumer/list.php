<?php if ($this->session->userdata('user_id')): ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">👥 Manajemen Konsumen</h1>
        <a href="<?php echo base_url('consumer/add'); ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            ➕ Tambah Konsumen
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">No</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Nama</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">No. Telepon</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Email</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Alamat</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($consumers)): ?>
                    <?php $no = 1; foreach ($consumers as $consumer): ?>
                    <tr class="border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $no++; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $consumer->name; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $consumer->phone; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $consumer->email ?? '-'; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo substr($consumer->address, 0, 30) . '...'; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                            <a href="<?php echo base_url('consumer/edit/' . $consumer->id); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">✏️ Edit</a>
                            <a href="<?php echo base_url('consumer/delete/' . $consumer->id); ?>" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm" onclick="return confirm('Yakin ingin menghapus?');">🗑️ Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-500">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>