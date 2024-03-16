<?php 
    include_once("../../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
</head>
<body>
    <form action="dsperpustakaan.php" method="get">
        <label>Cari: </label>
        <input type="text" name="cari">
        <input type="submit" name="Cari">
    </form>
    <?php 
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
        }
    ?>
    <table border="1">
        <h1>Data Buku Perpustakaan</h1>
        <a href="../../perpustakaan/tambah/tambah.php">| Tambah Buku |</a>
        <a href="../../perpustakaan/cetak.php" target="_blank"> Cetak |</a>
        <a href="../dashboard.php"> Home |</a><br><br>
            <?php 
                if (isset($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    $ambildata = mysqli_query($kon, "SELECT buku.*, matapelajaran.namapelajaran FROM buku 
                                                        INNER JOIN matapelajaran ON buku.matapelajaran_idpelajaran = matapelajaran.idpelajaran 
                                                        WHERE buku.id_buku LIKE '%".$cari."%' OR buku.judul LIKE '%".$cari."%' OR buku.penulis LIKE '%".$cari."%'");
                } else {
                    $ambildata = mysqli_query($kon, "SELECT buku.*, matapelajaran.namapelajaran FROM buku 
                                                        INNER JOIN matapelajaran ON buku.matapelajaran_idpelajaran = matapelajaran.idpelajaran 
                                                        ORDER BY buku.id_buku ASC");
                    $num = mysqli_num_rows($ambildata);
                }
            ?>
        <tr>
            <th>Test</th>
            <th>ID Buku</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Keterangan</th>
            <th>Stok</th>
            <th>Gambar</th>
            <th>Mata pelajaran</th>
            <th>Aksi</th>
        </tr>   
        <?php 
            while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                echo "<tr>";
                echo "<td>" . $id = $userAmbilData['id_buku'] . "</td>";
                echo "<td>" . $judul = $userAmbilData['judul'] . "</td>";
                echo "<td>" . $penulis = $userAmbilData['penulis'] . "</td>";
                echo "<td>" . $keterangan = $userAmbilData['keterangan'] . "</td>";
                echo "<td>" . $stok = $userAmbilData['stok'] . "</td>";
                echo "<td>";
                        $data = mysqli_query($kon, "SELECT * FROM buku WHERE id_buku = '{$userAmbilData['id_buku']}'");
                        while ($row = mysqli_fetch_array($data)) {
                            echo "<a href='javascript:void(0);' onclick=\"window.open(../../perpustakaan/aset/{$row['gambar']}', '_blank');\">
                                    <img src='../../perpustakaan/aset/{$row['gambar']}' alt='Gambar Guru' width='110' height='150'></a>";
                        }
                    "</td>";
                echo "<td>" . $mata_pelajaran = $userAmbilData['namapelajaran'] . "</td>";

                echo "<td> 
                    | <a href='../../perpustakaan/view/pinjam.php?id=" .$userAmbilData['id_buku']. "'>Pinjam Buku</a> | 
                    <a href='../../perpustakaan/update/update.php?id=" .$userAmbilData['id_buku']. "'>Update</a> |
                    <a href='../../perpustakaan/view/view.php?id=" .$userAmbilData['id_buku']. "'>View</a> |
                    <a href='../../perpustakaan/bukuhapus.php?id=" .$userAmbilData['id_buku']. "'>Hapus</a> |
                    </td>";
                    
            }
        ?>
</body>
</html>