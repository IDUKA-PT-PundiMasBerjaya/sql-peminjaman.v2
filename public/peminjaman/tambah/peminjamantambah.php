<?php 
    include_once("../../../config/koneksi.php");

    class PeminjamanController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function tambahPeminjaman() {
            $setAuto = mysqli_query($this->kon, "SELECT MAX(id_peminjaman) AS max_id FROM peminjaman");
            $result = mysqli_fetch_assoc($setAuto);
            $max_id = $result['max_id'];

            if (is_numeric($max_id)) {
                $nounik = $max_id + 1;
            } else {
                $nounik = 1;
            } return $nounik;
        }

        public function tambahDataPeminjaman($data) {
            $idpeminjaman = $data['id_peminjaman'];
            $tanggalpinjam = $data['tanggal_pinjam'];
            $tanggalkembali = $data['tanggal_kembali'];
            $guru_idguru = $data['guru_idguru'];
            $siswa_idsiswa = $data['siswa_idsiswa'];

            if (!empty($guru_idguru) && empty($siswa_idsiswa)) {
                $insertData = mysqli_query($this->kon, "INSERT INTO peminjaman(id_peminjaman, tanggal_pinjam, tanggal_kembali, guru_idguru) 
                                                        VALUES ('$idpeminjaman', '$tanggalpinjam', '$tanggalkembali', '$guru_idguru')");

                if ($insertData) {
                    return "Data berhasil disimpan";
                } else {
                    return "Gagal menyimpan data";
                }
            } else if (empty($guru_idguru) && !empty($siswa_idsiswa)) {
                $insertData = mysqli_query($this->kon, "INSERT INTO peminjaman(id_peminjaman, tanggal_pinjam, tanggal_kembali, siswa_idsiswa)
                                                        VALUES ('$idpeminjaman', '$tanggalpinjam', '$tanggalkembali', '$siswa_idsiswa')"); 
                
                if ($insertData) {
                    return "Data berhasil disimpan";
                } else {
                    return "Gagal menyimpan data";
                }
            } else if (empty($guru_idguru) && empty($siswa_idsiswa)) {
                return "Gagal menyimpan data. Harap pilih salah satu antara ID guru atau ID siswa control";
            } else {
                return "Gagal menyimpan data. Hanya boleh memilih salah satu antara ID guru atau ID siswa control";
            }
        }
    }
?>