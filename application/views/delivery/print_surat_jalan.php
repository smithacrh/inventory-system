<?php if ($this->session->userdata('user_id')): ?>
<!DOCTYPE html>
<html>
<head>
    <title>Surat Jalan #<?php echo $delivery->id; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid #333;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            margin-bottom: 30px;
        }
        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 15px;
        }
        .field {
            margin-bottom: 10px;
        }
        .field label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .field value {
            border-bottom: 1px dotted #333;
            padding: 5px 0;
            display: block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            text-align: center;
        }
        .signature {
            border-top: 1px solid #333;
            padding-top: 30px;
            height: 60px;
        }
        @media print {
            body {
                margin: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SURAT JALAN</h1>
            <p>No. <?php echo str_pad($delivery->id, 5, '0', STR_PAD_LEFT); ?></p>
        </div>

        <div class="content">
            <div class="row">
                <div class="field">
                    <label>Tanggal</label>
                    <value><?php echo date('d/m/Y', strtotime($delivery->delivery_date)); ?></value>
                </div>
                <div class="field">
                    <label>Jenis Pengiriman</label>
                    <value><?php echo $delivery->delivery_type; ?></value>
                </div>
            </div>

            <div class="field">
                <label>Konsumen</label>
                <value><?php echo $delivery->consumer_name; ?></value>
            </div>

            <div class="field">
                <label>Alamat</label>
                <value><?php echo $delivery->address; ?></value>
            </div>

            <div class="row">
                <div class="field">
                    <label>Telepon</label>
                    <value><?php echo $delivery->phone; ?></value>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $delivery->item_name; ?></td>
                        <td><?php echo $delivery->quantity; ?></td>
                        <td><?php echo $delivery->unit; ?></td>
                        <td>Rp -</td>
                        <td>Rp -</td>
                    </tr>
                </tbody>
            </table>

            <?php if ($delivery->notes): ?>
            <div class="field">
                <label>Catatan</label>
                <value><?php echo $delivery->notes; ?></value>
            </div>
            <?php endif; ?>
        </div>

        <div class="footer">
            <div class="signature">
                <p>Pengirim</p>
            </div>
            <div class="signature">
                <p>Penerima</p>
            </div>
            <div class="signature">
                <p><?php echo $delivery->created_by_name; ?></p>
            </div>
        </div>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
            🖨️ Print
        </button>
        <button onclick="window.close()" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">
            ❌ Tutup
        </button>
    </div>
</body>
</html>
<?php endif; ?>