<?php 
    include_once("../../../config/koneksi.php");

    class PeminjamanController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function getPeminjamanData($id) {
            $result = mysqli_query($this->kon, "SELECT p.id_peminjaman, p.tanggal_pinjam, p.tanggal_kembali,
                                                    CASE
                                                        WHEN p.guru_idguru IS NOT NULL THEN g.nama
                                                        WHEN p.siswa_idsiswa IS NOT NULL THEN s.nama
                                                    END AS namapengguna
                                                FROM peminjaman p
                                                LEFT JOIN guru g ON p.guru_idguru = g.idguru
                                                LEFT JOIN siswa s ON p.siswa_idsiswa = s.idsiswa
                                                WHERE p.id_peminjaman = '$id'");
            return mysqli_fetch_array($result);
        }
    }

    $peminjamanController = new PeminjamanController($kon);
    $id = $_GET['id_peminjaman'];
    $peminjamanData = $peminjamanController->getPeminjamanData($id);

    if ($peminjamanData) {
        $id = $peminjamanData['id_peminjaman'];
        $namapengguna = $peminjamanData['namapengguna'];
        $tglpinjam = $peminjamanData['tanggal_pinjam'];
        $tglkembali = $peminjamanData['tanggal_kembali'];
    }
?>