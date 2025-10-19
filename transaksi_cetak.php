<?php
require_once('config/koneksi.php');

$id = $_GET['id'];

$query = "SELECT t.*, k.nama_konsumen, p.nama_paket 
          FROM transaksi t
          JOIN konsumen k ON t.id_konsumen = k.id_konsumen
          JOIN paket p ON t.id_paket = p.id_paket
          WHERE t.id_transaksi = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($hasil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi - <?php echo htmlspecialchars($data['nama_konsumen']); ?></title>
    <style>
        body { font-family: 'Arial', sans-serif; font-size: 14px; line-height: 1.6; }
        .container { width: 80%; margin: auto; padding: 20px; border: 1px solid #ccc; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 8px 0; }
        .label { width: 150px; }
        .signature { margin-top: 80px; text-align: right; }
    </style>
</head>
<body onload="window.print()">

    <div class="container">
        <h2>Nota Transaksi</h2>
        
        <table>
            <tr>
                <td class="label">Tanggal Transaksi</td>
                <td>: <?php echo date('d-m-Y', strtotime($data['tanggal_transaksi'])); ?></td>
            </tr>
            <tr>
                <td class="label">Konsumen</td>
                <td>: <?php echo htmlspecialchars($data['nama_konsumen']); ?></td>
            </tr>
            <tr>
                <td class="label">Tanggal Foto</td>
                <td>: <?php echo date('d-m-Y', strtotime($data['tanggal_foto'])); ?></td>
            </tr>
            <tr>
                <td class="label">Nama Paket</td>
                <td>: <?php echo htmlspecialchars($data['nama_paket']); ?></td>
                <td><strong>Harga Paket: Rp <?php echo number_format($data['harga_paket_saat_transaksi'], 0, ',', '.'); ?></strong></td>
            </tr>
        </table>

        <div class="signature">
            <p>Mengetahui,</p>
            <br><br><br>
            <p>Raditya Dwi Putra</p>
        </div>
    </div>

</body>
</html>