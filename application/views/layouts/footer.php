        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-200 dark:bg-gray-800 border-t border-gray-300 dark:border-gray-700 py-4 text-center text-gray-600 dark:text-gray-400">
        <p>&copy; 2026 Inventory Management System. All rights reserved.</p>
    </footer>

    <script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
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

        // Load theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const theme = localStorage.getItem('theme') || 'light';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        });
    </script>
</body>
</html>