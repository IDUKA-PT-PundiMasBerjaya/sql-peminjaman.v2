<?php 
	include_once("../../../config/koneksi.php");

	class BukuController {
		private $kon; 

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function tambahBuku() {
			$setAuto = mysqli_query($this->kon, "SELECT MAX(id_buku) AS max_id FROM buku");
			$result = mysqli_fetch_assoc($setAuto);
			$max_id = $result['max_id'];

			if (is_numeric($max_id)) {
				$nounik = $max_id + 1;
			} else {
				$nounik = 1;
			} return $nounik;
		}

		public function tambahDataBuku($data) {
			$id_buku = $data['id_buku'];
			$judul = $data['judul'];
			$penulis = $data['penulis'];
			$keterangan = $data['keterangan'];
            $stok = $data['stok'];
            $matapelajaran_idpelajaran = $data['matapelajaran_idpelajaran'];

			$ekstensi_diperbolehkan = array('jpeg', 'jpg', 'png');
			$namagambar = $_FILES['gambar']['name'];
			$x = explode('.', $namagambar);
			$ekstensi = strtolower(end($x));
			$ukuran = $_FILES['gambar']['size'];
			$file_temp = $_FILES['gambar']['tmp_name'];

			if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
				if ($ukuran <= 2000000) {
					move_uploaded_file($file_temp, '../aset/' . $namagambar);
					$insertData = mysqli_query($this->kon, "INSERT INTO buku(id_buku, judul, penulis, keterangan, stok, gambar, matapelajaran_idpelajaran) VALUES ('$id_buku', '$judul', '$penulis', '$keterangan', '$stok', '$namagambar', '$matapelajaran_idpelajaran')");
					
					if ($insertData) {
						return "Data berhasil disimpan";
					} else {
						return "Gagal menyimpan data";
					}
				} else {
					echo "<div style='color: red'>
							Ukuran file terlalu besar! Silahkan pilih file yang lebih kecil.
						</div>";
				}
			} else {
				echo "<div style='color: red'>
						Ekstensi file yang di upload tidak diizinkan!
					</div>";
			}

		}
	}
?>