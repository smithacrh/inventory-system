<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Data Konsumen</h3>
        <button onclick="showConsumerModal()" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Tambah Konsumen
        </button>
    </div>

    <table id="consumerTable" class="w-full">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal Konsumen -->
<div id="consumerModal" class="hidden modal-overlay">
    <div class="modal-content">
        <h3 class="text-lg font-bold mb-4" id="modalTitle">Tambah Konsumen</h3>
        <form id="consumerForm" class="space-y-4">
            <input type="hidden" id="consumerId" name="id">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Konsumen</label>
                <input type="text" name="name" id="consumerName" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Alamat</label>
                <textarea name="address" id="consumerAddress" required rows="4" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <div class="flex gap-2 justify-end">
                <button type="button" onclick="closeConsumerModal()" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    let consumerTable;
    
    $(document).ready(function() {
        consumerTable = $('#consumerTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('consumer/get_datatable') ?>',
                type: 'POST'
            },
            columnDefs: [
                { targets: -1, orderable: false }
            ]
        });
    });

    function showConsumerModal() {
        document.getElementById('modalTitle').textContent = 'Tambah Konsumen';
        document.getElementById('consumerForm').reset();
        document.getElementById('consumerId').value = '';
        document.getElementById('consumerModal').classList.remove('hidden');
    }

    function closeConsumerModal() {
        document.getElementById('consumerModal').classList.add('hidden');
    }

    function editConsumer(id) {
        // Implement edit functionality
        document.getElementById('modalTitle').textContent = 'Edit Konsumen';
        document.getElementById('consumerModal').classList.remove('hidden');
    }

    function deleteConsumer(id) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus konsumen ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ef4444'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('consumer/delete') ?>',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showSuccess(response.message);
                            consumerTable.ajax.reload();
                        } else {
                            showError(response.message);
                        }
                    }
                });
            }
        });
    }

    document.getElementById('consumerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('consumerId').value;
        const url = id ? '<?= base_url('consumer/update') ?>' : '<?= base_url('consumer/create') ?>';
        
        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showSuccess(response.message);
                    closeConsumerModal();
                    consumerTable.ajax.reload();
                } else {
                    showError(response.message);
                }
            }
        });
    });
</script>
