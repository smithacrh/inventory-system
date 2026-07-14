<?php if ($this->session->userdata('user_id') && $this->session->userdata('user_level') == 1): ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow max-w-2xl">
    <h1 class="text-2xl font-bold mb-6"><?php echo $title; ?></h1>

    <?php if (validation_errors()): ?>
        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 rounded">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($user)): ?>
        <?php $form_action = base_url('user/edit/' . $user->id); ?>
    <?php else: ?>
        <?php $form_action = base_url('user/add'); ?>
    <?php endif; ?>

    <form method="post" action="<?php echo $form_action; ?>" class="space-y-4">
        <?php if (!isset($user)): ?>
        <div>
            <label class="block text-sm font-medium mb-2">Username</label>
            <input type="text" name="username" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" 
                value="<?php echo set_value('username'); ?>" required>
        </div>
        <?php else: ?>
        <div>
            <label class="block text-sm font-medium mb-2">Username</label>
            <input type="text" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 bg-gray-200" 
                value="<?php echo $user->username; ?>" disabled>
        </div>
        <?php endif; ?>

        <div>
            <label class="block text-sm font-medium mb-2">Nama</label>
            <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" 
                value="<?php echo isset($user) ? $user->name : set_value('name'); ?>" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Level User</label>
            <select name="level" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" required>
                <option value="">-- Pilih Level --</option>
                <?php foreach ($levels as $key => $value): ?>
                    <option value="<?php echo $key; ?>" <?php echo (isset($user) && $user->level == $key) ? 'selected' : ''; ?>>
                        <?php echo $value; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php if (!isset($user)): ?>
        <div>
            <label class="block text-sm font-medium mb-2">Password</label>
            <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Konfirmasi Password</label>
            <input type="password" name="password_confirm" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" required>
        </div>
        <?php else: ?>
        <div>
            <label class="block text-sm font-medium mb-2">Password Baru (kosongkan jika tidak ingin mengubah)</label>
            <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700">
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Konfirmasi Password</label>
            <input type="password" name="password_confirm" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700">
        </div>
        <?php endif; ?>

        <div class="flex space-x-3">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                💾 Simpan
            </button>
            <a href="<?php echo base_url('user'); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">
                ❌ Batal
            </a>
        </div>
    </form>
</div>
<?php elseif (!($this->session->userdata('user_level') == 1)): ?>
    <div class="bg-red-100 dark:bg-red-900 p-6 rounded-lg shadow text-red-700 dark:text-red-200">
        <h1 class="text-2xl font-bold mb-2">❌ Akses Ditolak</h1>
        <p>Anda tidak memiliki akses untuk halaman ini. Hanya Admin yang dapat mengakses User Management.</p>
    </div>
<?php endif; ?>