<?php 
    include_once("../../../config/koneksi.php");

    class GuruController {
        private $kon;


        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function getGuruData($id) {
            $result = mysqli_query($this->kon, "SELECT * FROM guru WHERE idguru = '$id'");
            return mysqli_fetch_array($result);
        }
    }

    $kelasController = new GuruController($kon);
    $id = $_GET['id'];
    $guruData = $kelasController->getGuruData($id);

    if ($guruData) {
        $idguru = $guruData['idguru'];
        $nama = $guruData['nama'];
        $alamat = $guruData['alamat'];
        $email = $guruData['email'];
        $no_hp = $guruData['no_hp'];
    }
?>