<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Surat Jalan</h3>
        <button onclick="showDeliveryModal()" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Buat Surat Jalan
        </button>
    </div>

    <!-- Filter Type -->
    <div class="mb-4">
        <div class="flex gap-2">
            <button class="btn btn-secondary" onclick="filterType('all')">Semua</button>
            <button class="btn btn-success" onclick="filterType('in')">Masuk</button>
            <button class="btn btn-primary" onclick="filterType('out')">Keluar</button>
        </div>
    </div>

    <table id="deliveryTable" class="w-full">
        <thead>
            <tr>
                <th>ID</th>
                <th>No Surat</th>
                <th>Tanggal</th>
                <th>No Kendaraan</th>
                <th>Tipe</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal Surat Jalan -->
<div id="deliveryModal" class="hidden modal-overlay">
    <div class="modal-content">
        <h3 class="text-lg font-bold mb-4">Buat Surat Jalan</h3>
        <form id="deliveryForm" class="space-y-4 max-h-96 overflow-y-auto">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">No Surat Jalan</label>
                <input type="text" name="letter_number" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal</label>
                <input type="date" name="letter_date" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">No Kendaraan</label>
                <input type="text" name="vehicle_number" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipe</label>
                <select name="type" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white">
                    <option value="">Pilih Tipe</option>
                    <option value="in">Masuk</option>
                    <option value="out">Keluar</option>
                </select>
            </div>
            <div class="flex gap-2 justify-end">
                <button type="button" onclick="closeDeliveryModal()" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    let deliveryTable;
    
    $(document).ready(function() {
        deliveryTable = $('#deliveryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('delivery/get_datatable') ?>',
                type: 'POST'
            },
            columnDefs: [
                { targets: -1, orderable: false }
            ]
        });
    });

    function showDeliveryModal() {
        document.getElementById('deliveryForm').reset();
        document.getElementById('deliveryModal').classList.remove('hidden');
    }

    function closeDeliveryModal() {
        document.getElementById('deliveryModal').classList.add('hidden');
    }

    function filterType(type) {
        // Add filter functionality
    }

    function deleteDelivery(id) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus surat jalan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ef4444'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('delivery/delete') ?>',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showSuccess(response.message);
                            deliveryTable.ajax.reload();
                        } else {
                            showError(response.message);
                        }
                    }
                });
            }
        });
    }

    document.getElementById('deliveryForm').addEventListener('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url('delivery/create') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showSuccess(response.message);
                    closeDeliveryModal();
                    deliveryTable.ajax.reload();
                } else {
                    showError(response.message);
                }
            }
        });
    });
</script>
