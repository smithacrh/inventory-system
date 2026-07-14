<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Data Kategori Barang</h3>
        <button onclick="showCategoryModal()" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Tambah Kategori
        </button>
    </div>

    <table id="categoryTable" class="w-full">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal Kategori -->
<div id="categoryModal" class="hidden modal-overlay">
    <div class="modal-content">
        <h3 class="text-lg font-bold mb-4" id="categoryModalTitle">Tambah Kategori</h3>
        <form id="categoryForm" class="space-y-4">
            <input type="hidden" id="categoryId" name="id">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Kategori</label>
                <input type="text" name="name" id="categoryName" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex gap-2 justify-end">
                <button type="button" onclick="closeCategoryModal()" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    let categoryTable;
    
    $(document).ready(function() {
        categoryTable = $('#categoryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('item_category/get_datatable') ?>',
                type: 'POST'
            },
            columnDefs: [
                { targets: -1, orderable: false }
            ]
        });
    });

    function showCategoryModal() {
        document.getElementById('categoryModalTitle').textContent = 'Tambah Kategori';
        document.getElementById('categoryForm').reset();
        document.getElementById('categoryId').value = '';
        document.getElementById('categoryModal').classList.remove('hidden');
    }

    function closeCategoryModal() {
        document.getElementById('categoryModal').classList.add('hidden');
    }

    function editCategory(id) {
        document.getElementById('categoryModalTitle').textContent = 'Edit Kategori';
        document.getElementById('categoryModal').classList.remove('hidden');
    }

    function deleteCategory(id) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus kategori ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ef4444'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('item_category/delete') ?>',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showSuccess(response.message);
                            categoryTable.ajax.reload();
                        } else {
                            showError(response.message);
                        }
                    }
                });
            }
        });
    }

    document.getElementById('categoryForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('categoryId').value;
        const url = id ? '<?= base_url('item_category/update') ?>' : '<?= base_url('item_category/create') ?>';
        
        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showSuccess(response.message);
                    closeCategoryModal();
                    categoryTable.ajax.reload();
                } else {
                    showError(response.message);
                }
            }
        });
    });
</script>
