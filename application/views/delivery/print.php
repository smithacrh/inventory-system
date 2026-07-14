<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surat Jalan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        table, th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .print { margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h1>SURAT JALAN</h1>
        <p><strong>No Surat:</strong> <?php echo $delivery->no_surat_jalan; ?></p>
        <p><strong>Tanggal:</strong> <?php echo date('d M Y', strtotime($delivery->tanggal_pengiriman)); ?></p>

        <table>
            <tr>
                <th>Keterangan</th>
                <th>Nilai</th>
            </tr>
            <tr>
                <td>Nama Konsumen</td>
                <td><?php echo $delivery->nama_konsumen; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?php echo $delivery->alamat; ?></td>
            </tr>
            <tr>
                <td>Barang</td>
                <td><?php echo $delivery->nama_barang; ?></td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td><?php echo $delivery->jumlah_pengiriman . ' ' . $delivery->satuan; ?></td>
            </tr>
        </table>

        <div class="print">
            <button onclick="window.print()">Print</button>
            <button onclick="window.close()">Tutup</button>
        </div>
    </div>
</body>
</html>