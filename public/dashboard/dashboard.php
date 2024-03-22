<?php 
    include_once("../../config/koneksi.php");

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../../login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dashboard</title>
</head>
<body>
    <h1>Halaman Dashboard</h1>
    |<a href="data/dsperpustakaan.php"> Perpustakaan </a>|
    |<a href="data/dsbukuminat.php"> Buku Yang Paling Diminati </a>|
    <br><br>
    |<a href="data/dspeminjaman.php"> Peminjaman </a>|
    |<a href="data/dspeminjaman_buku.php"> Data Peminjaman Buku </a>|
    |<a href="data/dspengembalian_buku.php"> Data Pengembalian Buku </a>|
    <br><br>
    |<a href="data/dssiswa.php"> Data Siswa </a>|
    |<a href="data/dsguru.php"> Data Guru </a>|
    |<a href="data/dsmatapelajaran.php"> Data Mata Pelajaran </a>|
    |<a href="data/dskelas.php"> Data Kelas </a>|
    <br><br>
    |<a href="../../logout.php"> Logout </a>|
</body>
</html>