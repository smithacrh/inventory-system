<?php if ($this->session->userdata('user_id') && $this->session->userdata('user_level') == 1): ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">👨‍💼 Manajemen User</h1>
        <a href="<?php echo base_url('user/add'); ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            ➕ Tambah User
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">No</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Username</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Nama</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Level</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Dibuat</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php $no = 1; foreach ($users as $user): ?>
                    <tr class="border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $no++; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo $user->username; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 font-medium"><?php echo $user->name; ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                            <?php 
                                $levels = array(1 => 'Admin', 2 => 'Operator Assembly', 3 => 'Operator Cutting', 4 => 'Driver');
                                echo $levels[$user->level];
                            ?>
                        </td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2"><?php echo date('d/m/Y', strtotime($user->created_at)); ?></td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                            <a href="<?php echo base_url('user/edit/' . $user->id); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">✏️ Edit</a>
                            <a href="<?php echo base_url('user/delete/' . $user->id); ?>" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm" onclick="return confirm('Yakin ingin menghapus?');">🗑️ Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-500">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php elseif (!($this->session->userdata('user_level') == 1)): ?>
    <div class="bg-red-100 dark:bg-red-900 p-6 rounded-lg shadow text-red-700 dark:text-red-200">
        <h1 class="text-2xl font-bold mb-2">❌ Akses Ditolak</h1>
        <p>Anda tidak memiliki akses untuk halaman ini. Hanya Admin yang dapat mengakses User Management.</p>
    </div>
<?php endif; ?>