<?php 
    include_once("../../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Buku Favorit</title>
</head>
<body>
    <form action="dsbukuminat.php" method="get">
        <label>Cari: </label>
        <input type="text" name="cari">
        <input type="submit" name="Cari" value="Cari">
    </form>
    <?php 
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
        }
    ?>
    <table border="1">
        <h1>Daftar Buku Paling Diminati</h1>
        <a href="../../bukuminat/cetak.php" target="_blank">| Cetak |</a>
        <a href="../dashboard.php"> Home |</a>
        <?php 
            if (isset($_GET['cari'])) {
                $cari = $_GET['cari'];
                $ambildata = mysqli_query($kon, "SELECT p.buku_id_buku, b.judul, b.gambar AS gambar_buku, 
                                                    SUM(p.jumlah_buku) as total_pinjaman
                                                    FROM peminjaman_buku p
                                                    JOIN buku b ON p.buku_id_buku = b.id_buku
                                                    WHERE p.buku_id_buku LIKE '%$cari%' OR b.judul LIKE '%$cari%'
                                                    GROUP BY p.buku_id_buku, b.judul");
            } else {
                $ambildata = mysqli_query($kon, "SELECT p.buku_id_buku, b.judul, SUM(p.jumlah_buku) as total_pinjaman
                                                    FROM peminjaman_buku p
                                                    JOIN buku b ON p.buku_id_buku = b.id_buku
                                                    GROUP BY p.buku_id_buku, b.judul
                                                    ORDER BY total_pinjaman DESC");
                $num = mysqli_num_rows($ambildata);
            }
        ?>
        <tr>
            <th> ID Buku </th>
            <th> Judul </th>
            <th> Gambar </th>
            <th> Total Pinjam </th>
            <th> Peminjam </th>
        </tr>
        <?php 
            if ($ambildata) {
                while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                    echo "<tr>";
                    echo "<td>" . $id = $userAmbilData['buku_id_buku'] . "</td>";
                    echo "<td>" . $judul = $userAmbilData['judul'] . "</td>";
                    echo "<td>";
                    $data = mysqli_query($kon, "SELECT * FROM buku WHERE id_buku = '{$userAmbilData['buku_id_buku']}'");
                    while ($row = mysqli_fetch_array($data)) {
                        echo "<a href='javascript:void(0);' onclick=\"window.open('../../perpustakaan/aset/{$row['gambar']}', '_blank');\">
                                    <img src='../../perpustakaan/aset/{$row['gambar']}' alt='Gambar Guru' width='110' height='150'></a>";
                    }
                    echo "</td>";
                    echo "<td>" . $total = $userAmbilData['total_pinjaman'] . "</td>";
                    echo "<td>|<a href='#?id=" .$userAmbilData['buku_id_buku']."'> List Peminjam </a>|</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Data tidak ditemukan.</td></tr>";
            }
        ?>
    </table>
</body>
</html>
