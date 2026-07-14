    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 dark:bg-gray-950 text-gray-100 mt-12 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm">&copy; 2026 Inventory Management System. All rights reserved.</p>
                </div>
                <div class="text-sm">
                    <p>Version 1.0.0</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Theme toggle
        const themeToggle = document.getElementById('themeToggle');
        themeToggle.addEventListener('click', () => {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    </script>
</body>
</html>