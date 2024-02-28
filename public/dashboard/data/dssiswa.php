<?php 
    include_once("../../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
</head>
<body>
    <form action="dssiswa.php" method="get">
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
        <h1>Data Siswa</h1>
        <a href="../../siswa/tambah/tambah.php">| Tambah Data Siswa |</a>
        <a href="../../siswa/cetak.php" target="_blank"> Cetak |</a>
        <a href="../dashboard.php"> Home |</a><br><br>
            <?php 
                if (isset($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    $ambildata = mysqli_query($kon, "SELECT * FROM siswa WHERE idsiswa LIKE '%" .$cari."%' OR nama LIKE '%" .$cari. "%'");
                } else{
                    $ambildata = mysqli_query($kon, "SELECT * FROM siswa ORDER BY 'idsiswa' ASC");
                    $num = mysqli_num_rows($ambildata);
                }
            ?>
            <tr>
                <th> ID </th>
                <th> Nama Siswa </th>
                <th> Alamat </th>
                <th> Email </th>
                <th> No. HP </th>
                <th> ID User </th>
                <th> Aksi </th>
            </tr>
            <tr>
                <?php 
                    while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                        echo "<tr>";
                            echo "<td>" . $id = $userAmbilData['idsiswa'] . "</td>";
                            echo "<td>" . $nama = $userAmbilData['nama'] . "</td>";
                            echo "<td>" . $alamat = $userAmbilData['alamat'] . "</td>";
                            echo "<td>" . $email = $userAmbilData['email'] . "</td>";
                            echo "<td>" . $nohp = $userAmbilData['no_hp'] . "</td>";
                            echo "<td>" . $iduser = $userAmbilData['users_id'] . "</td>";
                        echo "<td> 
                                <a href='../../siswa/view/view.php?id=" . $userAmbilData['idsiswa'] . "'>View</a> |
                                <a href='../../siswa/update/update.php?id=" . $userAmbilData['idsiswa'] . "'>Edit</a> |
                                <a href='../../siswa/siswahapus.php?id=" . $userAmbilData['idsiswa'] . "'>Hapus</a>
                            </td>";
                        echo "</tr>";
                    }
                ?>
            </tr>
    </table>
</body>
</html>