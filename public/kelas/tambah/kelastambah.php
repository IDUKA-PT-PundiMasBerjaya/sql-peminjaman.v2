<?php 
    include_once("../../../config/koneksi.php");

    class KelasController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function tambahKelas() {
            $setAuto = mysqli_query($this->kon, "SELECT MAX(id_kelas) AS max_id FROM kelas");
            $result = mysqli_fetch_assoc($setAuto);
            $max_id = $result['max_id'];

            if (is_numeric($max_id)) {
                $nounik = $max_id + 1;
            } else {
                $nounik = 1;
            } return $nounik;
        }

        public function tambahDataKelas($data) {
            $idkelas = $data['id_kelas'];
            $namakelas = $data['namakelas'];
            $kursi = $data['kursi'];
            $meja = $data['meja'];
            $idguru = $data['guru_idguru'];
            $idsiswa = $data['siswa_idsiswa'];

            $insertData = mysqli_query($this->kon, "INSERT INTO kelas(id_kelas, namakelas, kursi, meja, guru_idguru, siswa_idsiswa) VALUES ('$idkelas', '$namakelas', '$kursi', '$meja', '$idguru', '$idsiswa')");

			if ($insertData) {
				return "Data berhasil disimpan.";
			} else {
				return "Gagal menyimpan data.";
			}
        }
    }
?>