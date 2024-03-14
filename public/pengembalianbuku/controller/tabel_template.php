<a href="../../pengembalianbuku/tambah/tambah.php">| Tambah Data Buku |</a>
<a href="../../pengembalianbuku/" target="_blank">| Cetak |</a>
<a href="../../../public/dashboard/dashboard.php">| Home |</a>
<form action="../../dashboard/data/dspengembalian_buku.php" method="get">
    <label>Tampilkan :</label>
    <select name="perPage" onchange="this.form.submit()">
        <option value="15" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 5 ? 'selected' : ''; ?>>15</option>
        <option value="25" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 10 ? 'selected' : ''; ?>>25</option>
        <option value="35" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 20 ? 'selected' : ''; ?>>35</option>
        <option value="50" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 30 ? 'selected' : ''; ?>>50</option>
    </select>
</form>
<table border="1">
    <tr>
        <th> No Pengembalian </th>
        <th> ID Peminjaman </th>
        <th> Nama Peminjam </th>
        <th> Nama Buku </th>
        <th> Gambar </th>
        <th> Jumlah </th>
        <th> Sisa </th>
        <th> Tanggal Kembali </th>
        <th> Aksi </th>
    </tr>
    <?php 
        $prevPengembalianID = null;
        $rowSpanCounts = [];

        if ($num > 0) {
            while ($row = mysqli_fetch_array($ambildata)) {
                $pengembalianID = $row['id_pengembalian'];
                $rowSpanCounts[$pengembalianID][] = $row;
            }

            mysqli_data_seek($ambildata, 0);
            $no = $start + 1;
            foreach ($rowSpanCounts as $pengembalianID => $rows) {
                $rowSpanCount = count($rows);
                $firstRow = true;
                foreach ($rows as $key => $userAmbilData) {
                    echo "<tr>";
                    if ($firstRow) {
                        echo "<td rowspan='{$rowSpanCount}'>" . $userAmbilData['id_pengembalian'] . "</td>";
                        echo "<td rowspan='{$rowSpanCount}'>" . $userAmbilData['peminjaman_id_peminjaman'] . "</td>";
                        echo "<td rowspan='{$rowSpanCount}'>" . $userAmbilData['namapeminjaman'] . "</td>";
                        $firstRow = false;
                    }
                        echo "<td>" . $userAmbilData['nama_buku'] . "</td>";
                        echo "<td><img src='../../perpustakaan/aset/" . $userAmbilData['gambar_buku'] . "' width='110' height='150'></td>";
                        echo "<td>" . $userAmbilData['jumlah_buku'] . "</td>";
                        echo "<td>" . $userAmbilData['stok'] . "</td>";
                        echo "<td>" . $userAmbilData['tanggal_pengembalian'] . "</td>";

                        if ($key === 0) {
                            echo "<td rowspan='{$rowSpanCount}'>";
                            if (isset($userAmbilData['id_pengembalian'])) {
                                echo "<a href='../../pengembalianbuku/cetak/cetak.php?id_pengembalian={$userAmbilData['id_pengembalian']}'>Cetak</a>";
                            }
                            echo "</td>";
                        }
                    echo "</tr>";
                }
            }
        } else {
            echo "<tr><td colspan='10'>Data tidak ditemukan.</td></tr>";
        }
    ?>
</table>