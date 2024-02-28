<?php  
	include_once("../../../config/koneksi.php");
 
	class KelasController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function updateKelas($id, $namakelas, $idsiswa, $idguru, $kursi, $meja,) {
			$result = mysqli_query($this->kon, "UPDATE kelas SET namakelas = '$namakelas', siswa_idsiswa = '$idsiswa', guru_idguru = '$idguru', kursi = '$kursi', meja = '$meja', WHERE id_kelas = '$id'");

			if ($result) {
				return "Sukses meng-update data.";
			} else {
				return "Gagal meng-update data.";
			}
		}

		public function getDataKelas($id) {
			$sql = "SELECT * FROM kelas WHERE id_kelas = '$id'";
			$ambildata = $this->kon->query($sql);

			if ($result = mysqli_fetch_array($ambildata)) {
				return $result;
			} else {
				return null;
			}
		}
	}
	
?>