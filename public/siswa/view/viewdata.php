<?php 
    include_once("../../../config/koneksi.php");

    class SiswaController {
        private $kon;


        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function getSiswaData($id) {
            $result = mysqli_query($this->kon, "SELECT * FROM siswa WHERE idsiswa = '$id'");
            return mysqli_fetch_array($result);
        }
    }

    $kelasController = new SiswaController($kon);
    $id = $_GET['id'];
    $siswaData = $kelasController->getSiswaData($id);

    if ($siswaData) {
        $idsiswa = $siswaData['idsiswa'];
        $nama = $siswaData['nama'];
        $alamat = $siswaData['alamat'];
        $email = $siswaData['email'];
        $no_hp = $siswaData['no_hp'];
        $users_id = $siswaData['users_id'];
    }
?>