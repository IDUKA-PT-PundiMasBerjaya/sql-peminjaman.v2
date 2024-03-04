<?php 
    include_once("../../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Template</title>
</head>
<body>
    |<a href="#">Tambah Data Buku</a>
    |<a href="../../dashboard/dashboard.php"> Dashboard </a>
    |<a href="#" target="_blank"> Cetak </a>|
    <form action="../../dashboard/data/dspeminjamanbuku.php" method="get">
        <label>Tampilkan :</label>
        <select name="perPage" onchange="this.form.submit()">
            <option value="15" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 5 ? 'selected' : '' ?>>15</option>
            <option value="25" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 10 ? 'selected' : '' ?>>25</option>
            <option value="35" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 15 ? 'selected' : '' ?>>35</option>
            <option value="50" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 20 ? 'selected' : '' ?>>50</option"></option>
        </select>
    </form>
    <table border="1">
        <tr>
            <th> No </th>
            <th> Peminjaman ID Barang </th>
            <th> Nama Peminjam </th>
            <th> Nama Buku </th>
            <th> Gambar </th>
            <th> Jumlah </th>
            <th> Sisa </th>
            <th> Tanggal Pinjam </th>
            <th> Aksi </th>
        </tr>
        <?php 
            $revPeminjamanID = null;
            $rowspanCounts = [];
            if ($num > 0) {
                while ($row = mysqli_fetch_assoc($ambildata)) {
                    $peminjamanID = $row['id_peminjaman'];
                    $rowspanCounts[$peminjamanID][] = $row;
                }

                mysqli_data_seek($ambildata, 0);
                $no = $start + 1;
                foreach ($rowspanCounts as $peminjamanID => $rows) {
                    $rowspanCounts = count($rows);
                    foreach ($rows as $key => $userAmbilData) {
                        echo "<tr>";
                        if ($firstRow) {
                            echo "<td rowspan='{$rowspanCounts}'>" . $no++ . "</td>";
                            echo "<td rowspan='{$rowspanCounts}'>" . $userAmbilData['id_peminjaman'] . "</td>";
                            echo "<td rowspan='{$rowspanCounts}'>" . $userAmbilData['namapeminjaman'] . "</td>";
                            $firstRow = false;
                        }
                        echo "<td>" . $userAmbilData['nama_buku'] . "</td>";
                        echo "<td><img src='../../perpustakaan/aset/" . $userAmbilData['gambar'] . "' width='50' height='100'></td>";
                        echo "<td>" . $userAmbilData['jumlah_buku'] . "</td>";
                        echo "<td>" . $userAmbilData['stok'] . "</td>";
                        echo "<td>" . $userAmbilData['tanggal_pinjam'] . "</td>";
                        
                        if ($key === 0) {
                            echo "<td rowspan='{$rowspanCounts}'>";
                            if (isset($userAmbilData['id_peminjaman'])) {
                                echo "<a href='cetak.php?id_peminjaman={$userAmbilData['id_peminjaman']}'> Cetak </a>";
                            }
                            echo "</td>";
                        }
                    }
                }
            } else {
                echo "<tr><td colspan='10'>Tidak ada data</td></tr>";
            }
        ?>
    </table>
</body>
</html>