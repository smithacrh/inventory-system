<?php if (!$this->session->userdata('user_id')): ?>
<div class="min-h-screen bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg max-w-md w-full">
        <h1 class="text-3xl font-bold text-center mb-6">📦 Inventory System</h1>
        <h2 class="text-xl font-bold text-center mb-8">Daftar Akun</h2>

        <?php if (isset($error)): ?>
            <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 rounded">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (validation_errors()): ?>
            <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 rounded text-sm">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo base_url('auth/register'); ?>" class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-2">Nama Lengkap</label>
                <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Username</label>
                <input type="text" name="username" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirm" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded font-medium">
                Daftar
            </button>
        </form>

        <p class="text-center mt-4 text-sm">
            Sudah punya akun? <a href="<?php echo base_url('auth/login'); ?>" class="text-blue-500 hover:text-blue-600">Login di sini</a>
        </p>
    </div>
</div>
<?php endif; ?>