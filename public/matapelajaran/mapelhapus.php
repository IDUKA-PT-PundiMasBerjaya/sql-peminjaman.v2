<?php 
    include_once("../../config/koneksi.php");

    class MapelController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function deleteMapel($id) {
            $deletedata = mysqli_query($this->kon, "DELETE FROM matapelajaran WHERE idpelajaran = '$id'");

            if ($deletedata) {
                return "Data sukses Terhapus";
            } else {
            return "Data gagal terhapus;";
            }
        }
    }

    $kelasController = new MapelController($kon);
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $message = $kelasController->deleteMapel($id);
        echo $message;
        header("Location: ../dashboard/data/dsmatapelajaran.php");
    }
?>