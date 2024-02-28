<?php 
    include_once("../../../config/koneksi.php");

    class GuruController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function tambahGuru() {
            $setAuto = mysqli_query($this->kon, "SELECT MAX(idguru) AS max_id FROM guru");
            $result = mysqli_fetch_assoc($setAuto);
            $max_id = $result['max_id'];

            if (is_numeric($max_id)) {
                $nounik = $max_id + 1;
            } else {
                $nounik = 1;
            } return $nounik;
        }

        public function tambahDataGuru($data) {
            $idguru = $data['idguru'];
            $nama = $data['nama'];
            $alamat = $data['alamat'];
            $email = $data['email'];
            $no_hp = $data['no_hp'];

            $insertData = mysqli_query($this->kon, "INSERT INTO guru(idguru, nama, alamat, email, no_hp) VALUES ('$idguru', '$nama', '$alamat', '$email', '$no_hp')");

			if ($insertData) {
				return "Data berhasil disimpan.";
			} else {
				return "Gagal menyimpan data.";
			}
        }
    }
?>