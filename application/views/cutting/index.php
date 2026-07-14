<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Data Produksi Cutting</h3>
        <button onclick="showCuttingModal()" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Tambah Cutting
        </button>
    </div>

    <table id="cuttingTable" class="w-full">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Qty Cutting</th>
                <th>Sampah</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal Cutting -->
<div id="cuttingModal" class="hidden modal-overlay">
    <div class="modal-content">
        <h3 class="text-lg font-bold mb-4">Tambah Produksi Cutting</h3>
        <form id="cuttingForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Barang</label>
                <select name="item_id" id="cuttingItem" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Barang</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jumlah Cutting</label>
                <input type="number" name="quantity_produced" required min="1" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Jumlah Sampah</label>
                <input type="number" name="waste_quantity" value="0" min="0" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex gap-2 justify-end">
                <button type="button" onclick="closeCuttingModal()" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    let cuttingTable;
    
    $(document).ready(function() {
        cuttingTable = $('#cuttingTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('cutting/get_datatable') ?>',
                type: 'POST'
            },
            columnDefs: [
                { targets: -1, orderable: false }
            ]
        });
    });

    function showCuttingModal() {
        document.getElementById('cuttingForm').reset();
        document.getElementById('cuttingModal').classList.remove('hidden');
    }

    function closeCuttingModal() {
        document.getElementById('cuttingModal').classList.add('hidden');
    }

    function deleteCutting(id) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus cutting ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ef4444'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('cutting/delete') ?>',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showSuccess(response.message);
                            cuttingTable.ajax.reload();
                        } else {
                            showError(response.message);
                        }
                    }
                });
            }
        });
    }

    document.getElementById('cuttingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url('cutting/create') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showSuccess(response.message);
                    closeCuttingModal();
                    cuttingTable.ajax.reload();
                } else {
                    showError(response.message);
                }
            }
        });
    });
</script>
