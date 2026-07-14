<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Manajemen User</h3>
        <button onclick="showUserModal()" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Tambah User
        </button>
    </div>

    <table id="userTable" class="w-full">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal User -->
<div id="userModal" class="hidden modal-overlay">
    <div class="modal-content">
        <h3 class="text-lg font-bold mb-4" id="userModalTitle">Tambah User</h3>
        <form id="userForm" class="space-y-4">
            <input type="hidden" id="userId" name="id">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Username</label>
                <input type="text" name="username" id="userUsername" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                <input type="password" name="password" id="userPassword" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengubah password</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Level</label>
                <select name="level" id="userLevel" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Level</option>
                    <option value="1">Admin</option>
                    <option value="2">Operator Assembly</option>
                    <option value="3">Operator Cutting</option>
                    <option value="4">Driver</option>
                </select>
            </div>
            <div class="flex gap-2 justify-end">
                <button type="button" onclick="closeUserModal()" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    let userTable;
    
    $(document).ready(function() {
        userTable = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('user/get_datatable') ?>',
                type: 'POST'
            },
            columnDefs: [
                { targets: -1, orderable: false }
            ]
        });
    });

    function showUserModal() {
        document.getElementById('userModalTitle').textContent = 'Tambah User';
        document.getElementById('userForm').reset();
        document.getElementById('userId').value = '';
        document.getElementById('userPassword').required = true;
        document.getElementById('userModal').classList.remove('hidden');
    }

    function closeUserModal() {
        document.getElementById('userModal').classList.add('hidden');
    }

    function editUser(id) {
        document.getElementById('userModalTitle').textContent = 'Edit User';
        document.getElementById('userPassword').required = false;
        document.getElementById('userModal').classList.remove('hidden');
    }

    function deleteUser(id) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus user ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ef4444'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('user/delete') ?>',
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showSuccess(response.message);
                            userTable.ajax.reload();
                        } else {
                            showError(response.message);
                        }
                    }
                });
            }
        });
    }

    document.getElementById('userForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('userId').value;
        const url = id ? '<?= base_url('user/update') ?>' : '<?= base_url('user/create') ?>';
        
        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showSuccess(response.message);
                    closeUserModal();
                    userTable.ajax.reload();
                } else {
                    showError(response.message);
                }
            }
        });
    });
</script>
