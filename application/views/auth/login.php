<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventory System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        // Load saved theme
        document.addEventListener('DOMContentLoaded', function() {
            const theme = localStorage.getItem('theme') || 'light';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        });
    </script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-gray-900 dark:to-gray-800 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-full text-white mb-4">
                <i class="fas fa-boxes text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">KJU Inventory</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Sistem Manajemen Inventory Perusahaan</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-6">Login</h2>

            <form id="loginForm" class="space-y-4">
                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Username</label>
                    <input type="text" name="username" id="username" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400" placeholder="Masukkan username">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <input type="password" name="password" id="password" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400" placeholder="Masukkan password">
                </div>

                <!-- Remember Me & Theme Toggle -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" class="w-4 h-4" name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Ingat saya</span>
                    </label>
                    <button type="button" onclick="toggleTheme()" class="text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600">
                        <i class="fas fa-moon dark:hidden"></i>
                        <i class="fas fa-sun hidden dark:inline"></i>
                    </button>
                </div>

                <!-- Login Button -->
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
            </form>

            <!-- Demo Credentials -->
            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                <p class="text-xs text-gray-600 dark:text-gray-400 mb-3 font-semibold">Akun Demo:</p>
                <div class="space-y-1 text-xs text-gray-600 dark:text-gray-400">
                    <p><strong>Admin:</strong> admin / password</p>
                    <p><strong>Op. Assembly:</strong> operator_assembly / password</p>
                    <p><strong>Op. Cutting:</strong> operator_cutting / password</p>
                    <p><strong>Driver:</strong> driver / password</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleTheme() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const button = this.querySelector('button[type="submit"]');
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Loading...';

            $.ajax({
                url: '<?= base_url('auth/login') ?>',
                type: 'POST',
                data: {
                    username: username,
                    password: password
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Login Berhasil!',
                            text: 'Selamat datang!',
                            icon: 'success',
                            timer: 2000,
                            timerProgressBar: true
                        }).then(() => {
                            window.location.href = '<?= base_url('dashboard') ?>';
                        });
                    } else {
                        Swal.fire('Gagal!', response.message, 'error');
                        button.disabled = false;
                        button.innerHTML = '<i class="fas fa-sign-in-alt mr-2"></i> Login';
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Terjadi kesalahan pada server', 'error');
                    button.disabled = false;
                    button.innerHTML = '<i class="fas fa-sign-in-alt mr-2"></i> Login';
                }
            });
        });
    </script>
</body>
</html>
