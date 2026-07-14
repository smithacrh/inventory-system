<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Data Stok Barang</h3>
        <div class="flex gap-2">
            <a href="<?= base_url('item/add_stock') ?>" class="btn btn-primary">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Stok
            </a>
            <button onclick="showItemModal()" class="btn btn-secondary">
                <i class="fas fa-plus mr-2"></i> Barang Baru
            </button>
        </div>
    </div>

    <table id="itemTable" class="w-full">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
        <p class="text-sm text-gray-600 dark:text-gray-400">Total Stok Keseluruhan: <strong id="totalStock" class="text-lg text-blue-600 dark:text-blue-400">0</strong></p>
    </div>
</div>

<!-- Modal Item Baru -->
<div id="itemModal" class="hidden modal-overlay">
    <div class="modal-content">
        <h3 class="text-lg font-bold mb-4">Tambah Barang Baru</h3>
        <form id="itemForm" class="space-y-4">
            <input type="hidden" id="itemId" name="id">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Barang</label>
                <input type="text" name="name" id="itemName" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori</label>
                <select name="category_id" id="itemCategory" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Kategori</option>
                    <?php if(!empty($categories)): ?>
                        <?php foreach($categories as $cat): ?>
                            <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Stok Awal</label>
                <input type="number" name="stock" id="itemStock" value="0" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex gap-2 justify-end">
                <button type="button" onclick="closeItemModal()" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    let itemTable;
    
    $(document).ready(function() {
        itemTable = $('#itemTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('item/get_datatable') ?>',
                type: 'POST'
            },
            columnDefs: [
                { targets: -1, orderable: false }
            ]
        });
    });

    function showItemModal() {
        document.getElementById('itemForm').reset();
        document.getElementById('itemId').value = '';
        document.getElementById('itemModal').classList.remove('hidden');
    }

    function closeItemModal() {
        document.getElementById('itemModal').classList.add('hidden');
    }

    function editItem(id) {
        document.getElementById('itemModal').classList.remove('hidden');
    }

    function deleteItem(id) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus barang ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ef4444'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('item/delete') ?>',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showSuccess(response.message);
                            itemTable.ajax.reload();
                        } else {
                            showError(response.message);
                        }
                    }
                });
            }
        });
    }

    document.getElementById('itemForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('itemId').value;
        const url = id ? '<?= base_url('item/update') ?>' : '<?= base_url('item/create') ?>';
        
        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showSuccess(response.message);
                    closeItemModal();
                    itemTable.ajax.reload();
                } else {
                    showError(response.message);
                }
            }
        });
    });
</script>
