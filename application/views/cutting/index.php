<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            <i class="fas fa-cut text-red-500"></i> Manajemen Pemotongan Barang
        </h2>
        <a href="<?php echo base_url('cutting/add'); ?>" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium">
            <i class="fas fa-plus"></i> Tambah Pemotongan
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left font-semibold">No</th>
                    <th class="px-4 py-2 text-left font-semibold">Barang</th>
                    <th class="px-4 py-2 text-right font-semibold">Cutting</th>
                    <th class="px-4 py-2 text-right font-semibold">Waste</th>
                    <th class="px-4 py-2 text-left font-semibold">Petugas</th>
                    <th class="px-4 py-2 text-left font-semibold">Tanggal</th>
                    <th class="px-4 py-2 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($cuttings)): ?>
                    <?php $no = 1; foreach($cuttings as $cut): ?>
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3"><?php echo $no++; ?></td>
                            <td class="px-4 py-3 font-medium"><?php echo $cut->nama_barang; ?></td>
                            <td class="px-4 py-3 text-right"><?php echo $cut->jumlah_cutting; ?></td>
                            <td class="px-4 py-3 text-right text-red-600 dark:text-red-400 font-semibold"><?php echo $cut->jumlah_waste; ?></td>
                            <td class="px-4 py-3"><?php echo $cut->nama_lengkap ?? 'System'; ?></td>
                            <td class="px-4 py-3"><?php echo date('d M Y H:i', strtotime($cut->created_at)); ?></td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="<?php echo base_url('cutting/edit/' . $cut->id); ?>" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?php echo base_url('cutting/delete/' . $cut->id); ?>" onclick="return confirm('Yakin ingin hapus?');" class="inline-block bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">Belum ada data pemotongan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>