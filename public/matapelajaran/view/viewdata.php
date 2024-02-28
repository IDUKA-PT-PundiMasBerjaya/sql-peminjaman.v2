<?php 
    include_once("../../../config/koneksi.php");

    class MapelController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function getMapelData($id) {
            $result = mysqli_query($this->kon, "SELECT * FROM matapelajaran WHERE idpelajaran = '$id'");
            return mysqli_fetch_array($result);
        }
    }

    $kelasController = new MapelController($kon);
    $id = $_GET['id'];
    $mapelData = $kelasController->getMapelData($id);

    if ($mapelData) {
        $id = $mapelData['guru_idguru'];
        $namapelajaran = $mapelData['namapelajaran'];
        $idguru = $mapelData['guru_idguru'];
    }
?>