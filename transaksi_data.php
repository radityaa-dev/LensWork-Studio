<?php
require_once('config/koneksi.php');
include('template/header.php');
?>

<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Data Transaksi</h2>
        <a href="transaksi_tambah.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Transaksi
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">No</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Tgl Transaksi</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Konsumen</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Tgl Foto</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Paket</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Harga</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Cetak</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <?php
                $query = "SELECT transaksi.*, konsumen.nama_konsumen, paket.nama_paket 
                          FROM transaksi 
                          JOIN konsumen ON transaksi.id_konsumen = konsumen.id_konsumen 
                          JOIN paket ON transaksi.id_paket = paket.id_paket
                          ORDER BY transaksi.id_transaksi DESC";
                
                $hasil = mysqli_query($koneksi, $query);
                $no = 1;

                if(mysqli_num_rows($hasil) == 0) {
                    echo "<tr><td colspan='7' class='text-center py-4'>Belum ada transaksi.</td></tr>";
                } else {
                    while ($data = mysqli_fetch_assoc($hasil)) {
                ?>
                    <tr class="border-b">
                        <td class="py-3 px-4"><?php echo $no++; ?></td>
                        <td class="py-3 px-4"><?php echo date('d-m-Y', strtotime($data['tanggal_transaksi'])); ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($data['nama_konsumen']); ?></td>
                        <td class="py-3 px-4"><?php echo date('d-m-Y', strtotime($data['tanggal_foto'])); ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($data['nama_paket']); ?></td>
                        <td class="py-3 px-4">Rp <?php echo number_format($data['harga_paket_saat_transaksi'], 0, ',', '.'); ?></td>
                        <td class="py-3 px-4 text-center">
                            <a href="transaksi_cetak.php?id=<?php echo $data['id_transaksi']; ?>" target="_blank" class="text-sm bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded">Cetak</a>
                        </td>
                    </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
     <div class="mt-6 text-right">
        <a href="laporan_semua.php" target="_blank" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-6 rounded">
            Cetak Semua Data
        </a>
    </div>
</div>

<?php
include('template/footer.php');
?>