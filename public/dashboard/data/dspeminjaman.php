<?php 
    include_once("../../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Halaman Peminjaman</title>
</head>
<body>
    <form action="dspeminjaman.php" method="get">
        <label>Cari :</label>
        <input type="text" name="cari">
        <input type="submit" name="Cari">
    </form>
    <?php 
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
        }
    ?>
    <table border="1">
        <h1>Data Peminjaman</h1>
        <a href="../../peminjaman/tambah/tambah.php">| Tambah Data |</a>
        <a href="../../peminjaman/cetak.php" target="_blank"> Cetak |</a>
        <a href="../dashboard.php"> Home |</a>
            <?php 
                if (isset($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    $sql = "SELECT p.id_peminjaman, p.tanggal_pinjam, p.tanggal_kembali,
                                CASE
                                    WHEN p.guru_idguru IS NOT NULL THEN g.nama
                                    WHEN p.siswa_idsiswa IS NOT NULL THEN s.nama
                                END AS namapengguna
                            FROM peminjaman p
                            LEFT JOIN guru g ON p.guru_idguru = g.idguru
                            LEFT JOIN siswa s ON p.siswa_idsiswa = s.idsiswa
                            WHERE p.id_peminjaman LIKE '%".$cari."%' OR p.guru_idguru LIKE '%".$cari."%' OR p.siswa_idsiswa LIKE '%".$cari."%'";
                } else {
                    $sql = "SELECT p.id_peminjaman, p.tanggal_pinjam, p.tanggal_kembali,
                                CASE
                                    WHEN p.guru_idguru IS NOT NULL THEN g.nama
                                    WHEN p.siswa_idsiswa IS NOT NULL THEN s.nama
                                END AS namapengguna
                            FROM peminjaman p
                            LEFT JOIN guru g ON p.guru_idguru = g.idguru
                            LEFT JOIN siswa s ON p.siswa_idsiswa = s.idsiswa
                            ORDER BY p.id_peminjaman ASC";
                }

                $ambildata = mysqli_query($kon, $sql);
                $num = mysqli_num_rows($ambildata);
            ?>

        <tr>
            <th> ID Peminjaman </th>
            <th> Nama Pengguna </th>
            <th> Tanggal Pinjam </th>
            <th> Tanggal Kembali </th>
            <th> Aksi </th>
        </tr>
        <tr>
            <?php 
                while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                    echo "<tr>";
                        echo "<td>" . $id = $userAmbilData['id_peminjaman'] . "</td>";
                        echo "<td>" . $namapengguna = $userAmbilData['namapengguna'] . "</td>";
                        echo "<td>" . $tglpinjam = $userAmbilData['tanggal_pinjam'] . "</td>";
                        echo "<td>" . $tglkembali = $userAmbilData['tanggal_kembali'] . "</td>";
                        echo "<td>
                                | <a href='../../peminjaman/view/view.php?id_peminjaman=$id'>View</a> |
                                <a href='../../peminjaman/#?id_peminjaman=$id'>Update</a> | 
                            </td>";
                    echo "</tr>";
                }
            ?>
        </tr>
    </table>
</body>
</html>