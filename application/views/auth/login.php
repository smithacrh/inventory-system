<?php if ($this->session->userdata('user_id')): ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">🔐 Login</h1>
    </div>

    <div class="max-w-md mx-auto">
        <?php if (isset($error)): ?>
            <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 rounded">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo base_url('auth/login'); ?>" class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-2">Username</label>
                <input type="text" name="username" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded font-medium">
                Login
            </button>
        </form>

        <p class="text-center mt-4 text-sm">
            Belum punya akun? <a href="<?php echo base_url('auth/register'); ?>" class="text-blue-500 hover:text-blue-600">Daftar di sini</a>
        </p>
    </div>
</div>
<?php endif; ?>