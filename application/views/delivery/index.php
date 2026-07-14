<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            <i class="fas fa-truck text-pink-500"></i> Manajemen Surat Jalan
        </h2>
        <a href="<?php echo base_url('delivery/add'); ?>" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded-lg font-medium">
            <i class="fas fa-plus"></i> Tambah Surat Jalan
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left font-semibold">No</th>
                    <th class="px-4 py-2 text-left font-semibold">No Surat</th>
                    <th class="px-4 py-2 text-left font-semibold">Konsumen</th>
                    <th class="px-4 py-2 text-left font-semibold">Barang</th>
                    <th class="px-4 py-2 text-right font-semibold">Jumlah</th>
                    <th class="px-4 py-2 text-left font-semibold">Tanggal</th>
                    <th class="px-4 py-2 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($deliveries)): ?>
                    <?php $no = 1; foreach($deliveries as $deliv): ?>
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3"><?php echo $no++; ?></td>
                            <td class="px-4 py-3 font-medium"><?php echo $deliv->no_surat_jalan; ?></td>
                            <td class="px-4 py-3"><?php echo $deliv->nama_konsumen; ?></td>
                            <td class="px-4 py-3"><?php echo $deliv->nama_barang; ?></td>
                            <td class="px-4 py-3 text-right"><?php echo $deliv->jumlah_pengiriman; ?></td>
                            <td class="px-4 py-3"><?php echo date('d M Y', strtotime($deliv->tanggal_pengiriman)); ?></td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="<?php echo base_url('delivery/print_surat_jalan/' . $deliv->id); ?>" target="_blank" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-print"></i> Print
                                </a>
                                <a href="<?php echo base_url('delivery/edit/' . $deliv->id); ?>" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?php echo base_url('delivery/delete/' . $deliv->id); ?>" onclick="return confirm('Yakin ingin hapus?');" class="inline-block bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">Belum ada data surat jalan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>