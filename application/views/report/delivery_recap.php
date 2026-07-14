<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Rekap Surat Jalan</h3>
        <div class="flex gap-2">
            <input type="date" id="deliveryDate" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white" value="<?= $selected_date ?>">
            <button onclick="filterDeliveryByDate()" class="btn btn-primary">
                <i class="fas fa-search mr-2"></i> Filter
            </button>
        </div>
    </div>

    <table id="deliveryRecapTable" class="w-full">
        <thead>
            <tr>
                <th>No</th>
                <th>No Surat</th>
                <th>Tanggal</th>
                <th>No Kendaraan</th>
                <th>Tipe</th>
                <th>Dibuat Oleh</th>
                <th>Tanggal Buat</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($deliveries)): ?>
                <?php $no = 1; foreach($deliveries as $del): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $del->letter_number ?></td>
                        <td><?= date('d-m-Y', strtotime($del->letter_date)) ?></td>
                        <td><?= $del->vehicle_number ?></td>
                        <td>
                            <?php if($del->type == 'in'): ?>
                                <span class="badge badge-success">Masuk</span>
                            <?php else: ?>
                                <span class="badge badge-primary">Keluar</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $del->created_by_name ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($del->created_at)) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">Tidak ada data surat jalan untuk tanggal ini</td>
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
    function filterDeliveryByDate() {
        const date = document.getElementById('deliveryDate').value;
        if (date) {
            window.location.href = '<?= base_url('report/delivery_recap?date=') ?>' + date;
        }
    }

    function printReport() {
        window.print();
    }
</script>
