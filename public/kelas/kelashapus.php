<?php 
    include_once("../../config/koneksi.php");

    class KelasController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;   
        }

        public function deleteKelas($id) {
            $deletedata = mysqli_query($this->kon, "DELETE FROM kelas WHERE id_kelas = '$id'");

            if ($deletedata) {
                return "Data sukses terhapus";
            } else {
                return "Gagal menghapus data";
            }
        }
    }

    $sekolahController = new KelasController($kon);
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $message = $sekolahController->deleteKelas($id);
        echo $message;
        header("Location: ../dashboard/data/dskelas.php");
    }
?>