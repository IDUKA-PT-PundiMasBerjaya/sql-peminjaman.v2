<?php 
    include_once("../../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kelas</title>
</head>
<body>
    <form action="dskelas.php" method="get">
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
        <h1>Data Kelas</h1>
        <a href="../../kelas/tambah/tambah.php">| Tambah Data |</a>
        <a href="../../kelas/cetak.php" target="_blank"> Cetak |</a>
        <a href="../dashboard.php"> Home |</a><br><br>
            <?php 
                if (isset($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    $ambildata = mysqli_query($kon, "SELECT kelas.*, siswa.nama AS ketua_kelas, guru.nama AS wali_kelas 
                    FROM kelas 
                    INNER JOIN siswa ON kelas.siswa_idsiswa = siswa.idsiswa 
                    INNER JOIN guru ON kelas.guru_idguru = guru.idguru 
                    WHERE kelas.id_kelas LIKE '%".$cari."%' OR kelas.namakelas LIKE '%".$cari."%' OR siswa.nama LIKE '%".$cari."%' OR guru.nama LIKE '%".$cari."%'");
                } else {
                    $ambildata = mysqli_query($kon, "SELECT kelas.*, siswa.nama AS ketua_kelas, guru.nama AS wali_kelas 
                                                        FROM kelas 
                                                        INNER JOIN siswa ON kelas.siswa_idsiswa = siswa.idsiswa 
                                                        INNER JOIN guru ON kelas.guru_idguru = guru.idguru 
                                                        ORDER BY kelas.id_kelas ASC");
                    $num = mysqli_num_rows($ambildata);
                }
            ?>
        <tr>
            <th>ID Kelas</th>
            <th>Nama Kelas</th>
            <th>Ketua Kelas</th>
            <th>Wali Kelas</th>
            <th>Kursi</th>
            <th>Meja</th>
            <th>Gambar Kelas</th>
            <th>Aksi</th>
        </tr>   
        <?php 
            while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                echo "<tr>";
                echo "<td>" . $id = $userAmbilData['id_kelas'] . "</td>";
                echo "<td>" . $namakelas = $userAmbilData['namakelas'] . "</td>";
                echo "<td>" . $ketuakelas = $userAmbilData['ketua_kelas'] . "</td>";
                echo "<td>" . $walikelas = $userAmbilData['wali_kelas'] . "</td>";
                echo "<td>" . $kursi = $userAmbilData['kursi'] . "</td>";
                echo "<td>" . $meja = $userAmbilData['meja'] . "</td>";
                echo "<td>";
                        $data = mysqli_query($kon, "SELECT * FROM kelas WHERE id_kelas = '{$userAmbilData['id_kelas']}'");
                        while ($row = mysqli_fetch_array($data)) {
                            echo "<a href='javascript:void(0);' onclick=\"window.open(../../perpustakaan/aset/{$row['gambar_kelas']}', '_blank');\">
                                    <img src='../../perpustakaan/aset/{$row['gambar_kelas']}' alt='Gambar Kelas' width='110' height='150'></a>";
                        }
                    "</td>";
                echo "<td> 
                        | <a href='../../kelas/update/update.php?id=" .$userAmbilData['id_kelas']. "'>Edit</a> |
                        <a href='../../kelas/view/view.php?id=" .$userAmbilData['id_kelas']. "'>View</a> |
                        <a href='../../kelas/kelashapus.php?id=" .$userAmbilData['id_kelas']. "'>Hapus</a> |
                    </td>";
                    
            }
        ?>
</body>
</html>