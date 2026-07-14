<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            <i class="fas fa-users-cog text-cyan-500"></i> Manajemen User
        </h2>
        <a href="<?php echo base_url('user/add'); ?>" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-lg font-medium">
            <i class="fas fa-plus"></i> Tambah User
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left font-semibold">No</th>
                    <th class="px-4 py-2 text-left font-semibold">Username</th>
                    <th class="px-4 py-2 text-left font-semibold">Nama Lengkap</th>
                    <th class="px-4 py-2 text-left font-semibold">Role</th>
                    <th class="px-4 py-2 text-left font-semibold">Dibuat</th>
                    <th class="px-4 py-2 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($users)): ?>
                    <?php $no = 1; foreach($users as $user): ?>
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3"><?php echo $no++; ?></td>
                            <td class="px-4 py-3 font-medium"><?php echo $user->username; ?></td>
                            <td class="px-4 py-3"><?php echo $user->nama_lengkap; ?></td>
                            <td class="px-4 py-3">
                                <?php 
                                    $roles = [1 => 'Admin', 2 => 'Operator Assembly', 3 => 'Operator Cutting', 4 => 'Driver'];
                                    echo isset($roles[$user->role]) ? $roles[$user->role] : 'Unknown';
                                ?>
                            </td>
                            <td class="px-4 py-3"><?php echo date('d M Y', strtotime($user->created_at)); ?></td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="<?php echo base_url('user/edit/' . $user->id); ?>" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?php echo base_url('user/delete/' . $user->id); ?>" onclick="return confirm('Yakin ingin hapus?');" class="inline-block bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">Belum ada data user</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>