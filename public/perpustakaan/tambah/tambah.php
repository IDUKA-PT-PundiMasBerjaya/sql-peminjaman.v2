<?php 
    include_once("../../../config/koneksi.php");
    include_once("bukutambah.php");

    $bukuController = new BukuController($kon);

    if (isset($_POST['submit'])) {
        $id_buku = $bukuController->tambahBuku();

        $data = [
            'id_buku' => $id_buku,
            'judul' => $_POST['judul'],
            'penulis' => $_POST['penulis'],
            'keterangan' => $_POST['keterangan'],
            'stok' => $_POST['stok'],
            'matapelajaran_idpelajaran' => $_POST['matapelajaran_idpelajaran']
        ];

        $message = $bukuController->tambahDataBuku($data);
    }

    $dataMapel = "SELECT idpelajaran, namapelajaran FROM matapelajaran";
    $hasilMapel = mysqli_query($kon, $dataMapel);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tambah Buku</title>
</head>
<body>
    <h1>Tambah Data Buku</h1>
    <a href="../../dashboard/data/dsperpustakaan.php">| Home |</a>
    <form action="tambah.php" method="post" name="tambah" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>No ID</td>
                <td><input type="text" name="id_buku" value="<?php echo($bukuController->tambahBuku())?>" readonly></td>
            </tr>
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judul" required></td>
            </tr>
            <tr>
                <td>Penulis</td>
                <td><input type="text" name="penulis" required></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td><input type="text" name="keterangan" required></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td><input type="text" name="stok" required></td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td><input type="file" name="gambar" required></td>
            </tr>
            <tr>
                <td>ID Pelajaran</td>
                <td>
                    <select name="matapelajaran_idpelajaran" id="matapelajaran_idpelajaran">
                        <?php while ($row = mysqli_fetch_assoc($hasilMapel)) : ?>
                            <option value="<?php echo $row['idpelajaran'];?>">
                                <?php echo $row['idpelajaran'] . ' - ' . $row['namapelajaran']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Tambah Data">
        <?php if (isset($message)): ?>
            <div class="sucess-message">
                <?php echo($message) ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>