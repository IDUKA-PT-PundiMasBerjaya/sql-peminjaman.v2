<?php 
    include_once("../../../config/koneksi.php");

    if (isset($_GET['cari'])) {
        $cari = $_GET['cari'];
    }

    $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 15;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    $query = "SELECT pengembalian_buku.id_pengembalian, buku.judul AS nama_buku,
                CASE
                    WHEN siswa.nama IS NOT NULL THEN siswa.nama
                    WHEN guru.nama IS NOT NULL THEN guru.nama
                END AS namapeminjaman,
                pengembalian_buku.jumlah_buku,
                buku.stok,
                buku.gambar AS gambar_buku,
                pengembalian_buku.tanggal_pengembalian,
                peminjaman.id_peminjaman AS peminjaman_id_peminjaman,
                pengembalian_buku.denda
                FROM
                pengembalian_buku
                JOIN
                peminjaman ON pengembalian_buku.id_pengembalian = peminjaman.id_peminjaman
                LEFT JOIN
                siswa ON peminjaman.siswa_idsiswa = siswa.idsiswa
                LEFT JOIN
                guru ON peminjaman.guru_idguru = guru.idguru
                JOIN
                buku ON pengembalian_buku.buku_id_buku = buku.id_buku";
    
    if (!empty($cari)) {
        $query .= " WHERE pengembalian_buku.id_pengembalian LIKE '%".$cari."%'
                    OR siswa.idsiswa LIKE '%".$cari."%'
                    OR guru.idguru LIKE '%".$cari."%'
                    OR buku.judul LIKE '%".$cari."%'";
    }

    $query .= " ORDER BY pengembalian_buku.id_pengembalian DESC LIMIT $start, $perPage";
    $ambildata = mysqli_query($kon, $query) or die(mysqli_error($kon));
    $num = mysqli_num_rows($ambildata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Halaman Data Pengembalian Barang </title>
</head>
<body>
    <form action="dspengembalian_buku.php" method="get">
        <label>Cari: </label>
        <input type="text" name="cari" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
        <input type="submit" value="Cari">
    </form>
    <?php include("../../pengembalianbuku/controller/tabel_template.php") ?>
    <?php 
        $totalPage = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM pengembalian_buku")); 
        $totalPage = ceil($totalPage / $perPage);
        include("../../pengembalianbuku/controller/pagination_template.php")
    ?>
</body>
</html>
