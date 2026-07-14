<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-8">
            <div class="text-center mb-8">
                <i class="fas fa-boxes text-blue-600 dark:text-blue-400 text-4xl mb-4"></i>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Inventory System</h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Silakan login untuk melanjutkan</p>
            </div>

            <form method="post" action="<?php echo base_url('auth/login'); ?>" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Username</label>
                    <input type="text" name="username" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

            <div class="text-center mt-6">
                <p class="text-gray-600 dark:text-gray-400 text-sm">Belum punya akun? <a href="<?php echo base_url('auth/register'); ?>" class="text-blue-600 dark:text-blue-400 hover:underline">Daftar di sini</a></p>
            </div>

            <!-- Demo Credentials -->
            <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900 rounded-lg">
                <p class="text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">Demo Credentials:</p>
                <p class="text-xs text-gray-600 dark:text-gray-400"><strong>Admin:</strong> admin / password</p>
                <p class="text-xs text-gray-600 dark:text-gray-400"><strong>Operator:</strong> operator_assembly / password</p>
            </div>
        </div>
    </div>
</div>