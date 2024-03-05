<?php 
    include_once("../../../config/koneksi.php");

    if (isset($_GET['cari'])) {
        $cari = $_GET['cari'];
    }

    $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 15;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    $query = "SELECT peminjaman_buku.id_peminjaman, buku.judul AS nama_buku,
                CASE
                    WHEN siswa.nama IS NOT NULL THEN siswa.nama
                    WHEN guru.nama IS NOT NULL THEN guru.nama
                END AS namapeminjaman,
                peminjaman_buku.jumlah_buku,
                buku.stok,
                buku.gambar AS gambar_buku,
                peminjaman.tanggal_pinjam
                FROM 
                peminjaman_buku
                JOIN 
                peminjaman ON peminjaman_buku.id_peminjaman = peminjaman.id_peminjaman                
                LEFT JOIN
                siswa ON peminjaman.siswa_idsiswa = siswa.idsiswa
                LEFT JOIN 
                guru ON peminjaman.guru_idguru = guru.idguru
                JOIN 
                buku ON peminjaman_buku.buku_id_buku = buku.id_buku";

    if (!empty($cari)) {
        $query .= " WHERE peminjaman_buku.id_peminjaman LIKE '%".$cari."%' 
                    OR guru.idguru LIKE '%".$cari."%' 
                    OR siswa.idsiswa LIKE '%".$cari."%' 
                    OR buku.judul LIKE '%".$cari."%'";
    }

    $query .= " ORDER BY peminjaman_buku.id_peminjaman DESC LIMIT $start, $perPage";
    $ambildata = mysqli_query($kon, $query);
    if (!$ambildata) {
        die('Error: ' . mysqli_error($kon));
    }
    $num = mysqli_num_rows($ambildata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Halaman Data Peminjaman Barang </title>
</head>
<body>
    <form action="dspeminjaman_buku.php" method="get">
        <label>Cari: </label>
        <input type="text" name="cari" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
        <input type="submit" value="Cari">
    </form>
    <?php include("../../peminjamanbuku/controller/tabel_template.php") ?> <!-- tabel_template.php -->
    <?php 
        $totalData = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM peminjaman_buku"));
        $totalPage = ceil($totalData / $perPage);
        include("../../peminjamanbuku/controller/pagination_template.php"); // pagination_template.php
    ?>
</body>
</html>