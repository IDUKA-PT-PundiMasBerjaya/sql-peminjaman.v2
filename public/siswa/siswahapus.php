<?php 
    include_once("../../config/koneksi.php");

    class SiswaController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function deleteSiswa($id) {
            $deletedata = mysqli_query($this->kon, "DELETE FROM siswa WHERE idsiswa = '$id'");

            if ($deletedata) {
                return "Data sukses terhapus";
            } else {
                return "Data gagal terhapus";
            }
        }
    }

    $kelasController = new SiswaController($kon);
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $message = $kelasController->deleteSiswa($id);
        echo $message;
        header("Location: ../dashboard/data/dssiswa.php?message=");
    }
?>