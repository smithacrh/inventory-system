<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Rekap Sampah Produksi</h3>
        <div class="flex gap-2">
            <input type="date" id="wasteDate" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white" value="<?= $selected_date ?>">
            <button onclick="filterWasteByDate()" class="btn btn-primary">
                <i class="fas fa-search mr-2"></i> Filter
            </button>
        </div>
    </div>

    <table id="wasteRecapTable" class="w-full">
        <thead>
            <tr>
                <th>No</th>
                <th>Tipe</th>
                <th>Qty Sampah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($wastes)): ?>
                <?php $no = 1; foreach($wastes as $waste): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <?php if($waste->type == 'production'): ?>
                                <span class="badge badge-warning">Produksi</span>
                            <?php else: ?>
                                <span class="badge badge-danger">Cutting</span>
                            <?php endif; ?>
                        </td>
                        <td class="font-semibold text-red-600 dark:text-red-400"><?= $waste->quantity ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($waste->created_at)) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">Tidak ada data sampah untuk tanggal ini</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
        <button onclick="printReport()" class="btn btn-secondary">
            <i class="fas fa-print mr-2"></i> Cetak
        </button>
    </div>
</div>

<script>
    function filterWasteByDate() {
        const date = document.getElementById('wasteDate').value;
        if (date) {
            window.location.href = '<?= base_url('report/waste_recap?date=') ?>' + date;
        }
    }

    function printReport() {
        window.print();
    }
</script>
