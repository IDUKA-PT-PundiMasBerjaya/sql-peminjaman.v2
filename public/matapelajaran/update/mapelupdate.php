<?php 
    include_once("../../../config/koneksi.php");

    class MapelController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function updateMapel($id, $namapelajaran, $idguru) {
            $result = mysqli_query($this->kon, "UPDATE matapelajaran SET namapelajaran = '$namapelajaran', guru_idguru = '$idguru' WHERE idpelajaran = '$id'");

            if ($result) {
                return "Sukses meng-update data";
            } else {
                return "Gagal meng-update data";
            }
        }

        public function getDataMapel($id) {
            $sql = "SELECT * FROM matapelajaran WHERE idpelajaran = '$id'";
            $ambilData = $this->kon->query($sql);

            IF ($result = mysqli_fetch_array($ambilData)) {
                return $result;
            } else {
                return null;
            }
        }
    }
?>