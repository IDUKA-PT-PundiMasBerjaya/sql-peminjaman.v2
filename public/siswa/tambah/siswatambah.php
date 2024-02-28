<?php 
    include_once("../../../config/koneksi.php");

    class SiswaController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function tambahSiswa() {
            $setAuto = mysqli_query($this->kon, "SELECT MAX(idsiswa) AS max_id FROM siswa");
            $result = mysqli_fetch_assoc($setAuto);
            $max_id = $result['max_id'];

            if (is_numeric($max_id)) {
                $nounik = $max_id + 1;
            } else {
                $nounik = 1;
            } return $nounik;
        }

        public function tambahDataSiswa($data) {
            $idsiswa = $data['idsiswa'];
            $nama = $data['nama'];
            $alamat = $data['alamat'];
            $email = $data['email'];
            $no_hp = $data['no_hp'];
            $users_id = $data['users_id'];

            $insertData = mysqli_query($this->kon, "INSERT INTO siswa(idsiswa, nama, alamat, email, no_hp, users_id) VALUES ('$idsiswa', '$nama', '$alamat', '$email', '$no_hp', '$users_id')");

			if ($insertData) {
				return "Data berhasil disimpan.";
			} else {
				return "Gagal menyimpan data.";
			}
        }
    }
?>