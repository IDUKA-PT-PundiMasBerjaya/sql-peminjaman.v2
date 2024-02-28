<?php 
    include_once("../../../config/koneksi.php");

    class KelasController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function getKelasData($id) {
            $result = mysqli_query($this->kon, "SELECT * FROM kelas WHERE id_kelas = '$id'");
            return mysqli_fetch_array($result);
        }
    }

    $sekolahController = new KelasController($kon);
    $id = $_GET['id'];
    $kelasData = $sekolahController->getKelasData($id);

    if ($kelasData) {
        $id = $kelasData['id_kelas'];
        $namakelas = $kelasData['namakelas'];
        $kursi = $kelasData['kursi'];
        $meja = $kelasData['meja'];
        $gambar_kelas = $kelasData['gambar_kelas'];
        $idguru = $kelasData['guru_idguru'];
        $idsiswa = $kelasData['siswa_idsiswa'];
    }
?>