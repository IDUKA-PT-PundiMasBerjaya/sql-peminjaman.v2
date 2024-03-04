<?php 
    include_once("../../../config/koneksi.php");
    include_once("peminjaman_buku.php");

    if (isset($_POST['submit'])) {
        $data = [
            'id_peminjaman' => (isset($_POST['id_peminjaman'])) ? $_POST['id_peminjaman'] : null,
            'jumlah_buku' => $_POST['jumlah_buku'],
            'buku_id_buku' => $_POST['buku_id_buku'],
        ];
        $message = $peminjamanBukuController->TambahDataPeminjamanBuku($data);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tambah Peminjaman</title>
</head>
<body>
    <h1>Tambah Data Peminjaman Buku</h1>
    <a href="../../dashboard/data/dspeminjaman.php">Home Peminjaman</a>
    <form action="tambah.php" method="post" name="tambah" enctype="multipart/form-data" onsubmit="return confirmSubmit()">
        <div class="table-container">
            <table>
                <tr><th>ID Peminjaman</th></tr>
                <tr>
                    <td>
                        <select name="id_peminjaman" id="id_peminjaman">
                            <?php if (mysqli_num_rows($hasilPeminjaman) > 0) : ?>
                                <option value="" disabled selected> Pilih ID Peminjaman </option>
                                <?php while ($row = mysqli_fetch_assoc($hasilPeminjaman)) : ?>
                                    <option value="<?php echo $row['id_peminjaman']; ?>">
                                        <?php echo $row['id_peminjaman'] . ' - ' . $row['namapeminjaman']; ?>
                                    </option>
                                    <?php endwhile; ?>
                            <?php else : ?>
                                <option value="" disabled selected> Tambahkan data peminjaman terlebih dahulu</option>
                            <?php endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>ID Barang</th>
                    <th>Jumlah</th>
                </tr>
                <tr>
                    <td>
                        <select name="buku_id_buku" id="buku_id_buku[]">
                            <?php if (mysqli_num_rows($hasilBuku) > 0) : ?>
                                <option value="" disabled selected>Pilih Buku</option>
                                <?php while ($row = mysqli_fetch_assoc($hasilBuku)) : ?>
                                    <option value="<?php echo $row['id_buku']; ?>">
                                        <?php echo $row['id_buku'] . ' - ' . $row['judul'] ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <option value="" disabled selected> Tambahkan data barang terlebih dahulu.</option>
                            <?php endif; ?>
                        </select>
                    </td>
                    <td><input type="number" name="jumlah_buku[]" required></td>
                </tr>
            </table>
        </div>
        <button type="button" class="add-row-button" onclick="addRow()">Tambah Barang</button>
        <input type="submit" name="submit" value="Tambah Data">
    </form>
</body>
</html>