<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            <i class="fas fa-users text-blue-500"></i> Manajemen Konsumen
        </h2>
        <a href="<?php echo base_url('consumer/add'); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
            <i class="fas fa-plus"></i> Tambah Konsumen
        </a>
    </div>

    <!-- Search -->
    <div class="mb-6">
        <form method="get" action="<?php echo base_url('consumer'); ?>" class="flex gap-2">
            <input type="text" name="search" placeholder="Cari konsumen..." class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-search"></i> Cari
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left font-semibold">No</th>
                    <th class="px-4 py-2 text-left font-semibold">Nama</th>
                    <th class="px-4 py-2 text-left font-semibold">Alamat</th>
                    <th class="px-4 py-2 text-left font-semibold">Telepon</th>
                    <th class="px-4 py-2 text-left font-semibold">Email</th>
                    <th class="px-4 py-2 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($consumers)): ?>
                    <?php $no = 1; foreach($consumers as $consumer): ?>
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3"><?php echo $no++; ?></td>
                            <td class="px-4 py-3 font-medium"><?php echo $consumer->nama_konsumen; ?></td>
                            <td class="px-4 py-3"><?php echo $consumer->alamat; ?></td>
                            <td class="px-4 py-3"><?php echo $consumer->telepon; ?></td>
                            <td class="px-4 py-3"><?php echo $consumer->email; ?></td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="<?php echo base_url('consumer/edit/' . $consumer->id); ?>" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?php echo base_url('consumer/delete/' . $consumer->id); ?>" onclick="return confirm('Yakin ingin hapus?');" class="inline-block bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">Belum ada data konsumen</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>