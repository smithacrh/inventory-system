<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Rekap Stok Barang</h3>
        <div class="flex gap-2">
            <input type="date" id="stockDate" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white">
            <button onclick="filterStockByDate()" class="btn btn-primary">
                <i class="fas fa-search mr-2"></i> Filter
            </button>
        </div>
    </div>

    <table id="stockRecapTable" class="w-full">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($stock_recap)): ?>
                <?php $no = 1; foreach($stock_recap as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $item->name ?></td>
                        <td><?= $item->category_name ?></td>
                        <td class="font-semibold text-blue-600 dark:text-blue-400"><?= $item->stock ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">Tidak ada data</td>
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
    function filterStockByDate() {
        const date = document.getElementById('stockDate').value;
        if (date) {
            window.location.href = '<?= base_url('report/stock_recap?date=') ?>' + date;
        }
    }

    function printReport() {
        window.print();
    }
</script>
