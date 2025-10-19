<?php
require_once('config/koneksi.php');
include('template/header.php');
?>

<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Data Paket Fotografi</h2>
        <a href="paket_tambah.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Paket
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200">
                <tr>
                    <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm text-left">No</th>
                    <th class="w-3/12 py-3 px-4 uppercase font-semibold text-sm text-left">Nama Paket</th>
                    <th class="w-2/12 py-3 px-4 uppercase font-semibold text-sm text-left">Harga</th>
                    <th class="w-4/12 py-3 px-4 uppercase font-semibold text-sm text-left">Deskripsi</th>
                    <th class="w-2/12 py-3 px-4 uppercase font-semibold text-sm text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <?php
                $query = "SELECT * FROM paket ORDER BY id_paket DESC";
                $hasil = mysqli_query($koneksi, $query);
                $no = 1;

                if(mysqli_num_rows($hasil) == 0) {
                    echo "<tr><td colspan='5' class='text-center py-4'>Tidak ada data paket saat ini.</td></tr>";
                } else {
                    while ($data = mysqli_fetch_assoc($hasil)) {
                ?>
                    <tr class="border-b">
                        <td class="py-3 px-4"><?php echo $no++; ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($data['nama_paket']); ?></td>
                        <td class="py-3 px-4">Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($data['deskripsi']); ?></td>
                        <td class="py-3 px-4 text-center">
                            <a href="paket_edit.php?id=<?php echo $data['id_paket']; ?>" class="text-sm bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">Ubah</a>
                            <a href="paket_hapus.php?id=<?php echo $data['id_paket']; ?>" class="text-sm bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include('template/footer.php');
?>