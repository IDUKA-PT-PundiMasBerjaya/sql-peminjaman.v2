<?php 
    include_once("../../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mata Pelajaran</title>
</head>
<body>
    <form action="dsmatapelajaran.php" method="get">
        <label>Cari: </label>
        <input type="text" name="cari">
        <input type="submit" name="Cari">
    </form>
    <?php 
        if(isset($_GET['cari'])) {
            $cari = $_GET['cari'];
        }
    ?>
    <table border="1">
        <h1>Data Mata Pelajaran</h1>
        <a href="../../matapelajaran/tambah/tambah.php">| Tambah Data |</a>
        <a href="../../matapelajaran/cetak.php" target="_blank"> Cetak |</a>
        <a href="../dashboard.php"> Home |</a>
            <?php 
                if (isset($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    $ambildata = mysqli_query($kon, "SELECT matapelajaran.*, guru.nama AS nama_guru 
                                                      FROM matapelajaran 
                                                      INNER JOIN guru ON matapelajaran.guru_idguru = guru.idguru 
                                                      WHERE matapelajaran.idpelajaran LIKE '%" .$cari."%' OR matapelajaran.namapelajaran LIKE '%" .$cari. "%'");
                } else{
                    $ambildata = mysqli_query($kon, "SELECT matapelajaran.*, guru.nama AS nama_guru 
                                                      FROM matapelajaran 
                                                      INNER JOIN guru ON matapelajaran.guru_idguru = guru.idguru 
                                                      ORDER BY matapelajaran.idpelajaran ASC");
                    $num = mysqli_num_rows($ambildata);
                }
            ?>
        <tr>
            <th> ID </th>
            <th> Mata Pelajaran </th>
            <th> Nama Guru </th>
            <th> Aksi </th>
        </tr>
        <?php 
            while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                echo "<tr>";
                    echo "<td>" . $id = $userAmbilData['idpelajaran'] . "</td>";
                    echo "<td>" . $namapelajaran = $userAmbilData['namapelajaran'] ."</td>";
                    echo "<td>" . $namaguru = $userAmbilData['nama_guru'] . "</td>";
                    echo "<td>
                            <a href='../../matapelajaran/view/view.php?id=" . $userAmbilData['idpelajaran'] . "'>View</a> |
                            <a href='../../matapelajaran/update/update.php?id=" . $userAmbilData['idpelajaran'] . "'>Edit</a> |
                            <a href='../../matapelajaran/mapelhapus.php?id=" . $userAmbilData['idpelajaran'] . "'>Hapus</a>
                        </td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>