<?php if ($this->session->userdata('user_id')): ?>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">📊 Laporan</h1>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <a href="<?php echo base_url('report/stock'); ?>" class="bg-blue-500 hover:bg-blue-600 text-white p-6 rounded-lg text-center font-bold">
            📦 Laporan Stok
        </a>
        <a href="<?php echo base_url('report/production'); ?>" class="bg-green-500 hover:bg-green-600 text-white p-6 rounded-lg text-center font-bold">
            🏭 Laporan Produksi
        </a>
        <a href="<?php echo base_url('report/cutting'); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white p-6 rounded-lg text-center font-bold">
            ✂️ Laporan Pemotongan
        </a>
        <a href="<?php echo base_url('report/delivery'); ?>" class="bg-purple-500 hover:bg-purple-600 text-white p-6 rounded-lg text-center font-bold">
            🚚 Laporan Pengiriman
        </a>
        <a href="<?php echo base_url('report/waste'); ?>" class="bg-red-500 hover:bg-red-600 text-white p-6 rounded-lg text-center font-bold">
            ♻️ Laporan Limbah
        </a>
    </div>
</div>
<?php endif; ?>