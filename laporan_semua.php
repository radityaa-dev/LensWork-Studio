<?php
require_once('config/koneksi.php');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Semua Transaksi</title>
    <style>
        body { font-family: 'Arial', sans-serif; }
        .container { width: 90%; margin: auto; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; }
    </style>
</head>
<body onload="window.print()">

    <div class="container">
        <h2>LAPORAN SEMUA TRANSAKSI</h2>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Transaksi</th>
                    <th>Nama Konsumen</th>
                    <th>Tanggal Foto</th>
                    <th>Nama Paket</th>
                    <th>Harga Paket</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT t.*, k.nama_konsumen, p.nama_paket 
                          FROM transaksi t
                          JOIN konsumen k ON t.id_konsumen = k.id_konsumen
                          JOIN paket p ON t.id_paket = p.id_paket
                          ORDER BY t.tanggal_transaksi ASC";
                
                $hasil = mysqli_query($koneksi, $query);
                $no = 1;
                $total = 0;

                while ($data = mysqli_fetch_assoc($hasil)) {
                    $total += $data['harga_paket_saat_transaksi'];
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($data['tanggal_transaksi'])); ?></td>
                    <td><?php echo htmlspecialchars($data['nama_konsumen']); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($data['tanggal_foto'])); ?></td>
                    <td><?php echo htmlspecialchars($data['nama_paket']); ?></td>
                    <td>Rp <?php echo number_format($data['harga_paket_saat_transaksi'], 0, ',', '.'); ?></td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="total" style="text-align:right;">Total</td>
                    <td class="total">Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>

</body>
</html>