<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Rekap Produksi Cutting</h3>
        <div class="flex gap-2">
            <input type="date" id="cuttingDate" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white" value="<?= $selected_date ?>">
            <button onclick="filterCuttingByDate()" class="btn btn-primary">
                <i class="fas fa-search mr-2"></i> Filter
            </button>
        </div>
    </div>

    <table id="cuttingRecapTable" class="w-full">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Qty Cutting</th>
                <th>Sampah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($cuttings)): ?>
                <?php $no = 1; foreach($cuttings as $cut): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $cut->item_name ?></td>
                        <td><?= $cut->category_name ?></td>
                        <td class="font-semibold text-red-600 dark:text-red-400"><?= $cut->quantity_produced ?></td>
                        <td><?= $cut->waste_quantity ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($cut->created_at)) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada data cutting untuk tanggal ini</td>
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
    function filterCuttingByDate() {
        const date = document.getElementById('cuttingDate').value;
        if (date) {
            window.location.href = '<?= base_url('report/cutting_recap?date=') ?>' + date;
        }
    }

    function printReport() {
        window.print();
    }
</script>
