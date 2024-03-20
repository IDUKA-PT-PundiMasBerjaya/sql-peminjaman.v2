<?php

    include_once("../../../config/koneksi.php");

    class TambahDataController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function TambahDataPengembalianBuku($data) {
            $jumlah_array = $data['jumlah_buku'];
            $tanggal_pengembalian = $data['tanggal_pengembalian'];
            $id_buku_array = $data['buku_id_buku'];
            $id_peminjaman = $data['peminjaman_id_peminjaman'];

            foreach ($id_buku_array as $key => $buku_id_buku) {
                $jumlah = $jumlah_array[$key];

                if (!is_numeric($jumlah)) {
                    return "Gagal menyimpan data, Jumlah bukan bilangan.";
                }

                $result = mysqli_query($this->kon, "SELECT tanggal_kembali FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'");
                $row = mysqli_fetch_assoc($result);
                $tanggal_kembali_peminjaman = $row['tanggal_kembali'];

                $perbedaan_hari = floor(strtotime($tanggal_pengembalian) - strtotime($tanggal_kembali_peminjaman)) / (60 * 60 * 24);

                $denda = 0;
                if ($perbedaan_hari > 0) {
                    $denda = $perbedaan_hari * 1000;
                }

                $insertData = mysqli_query($this->kon, "INSERT INTO pengembalian_buku(id_pengembalian, jumlah_buku, tanggal_pengembalian, buku_id_buku, peminjaman_id_peminjaman, denda)
                                                        VALUES ('$id_peminjaman', '$jumlah', '$tanggal_pengembalian', '$buku_id_buku', '$id_peminjaman', '$denda')");

                if (!$insertData) {
                    return "Gagal menyimpan data. Error : " . mysqli_error($this->kon);
                }
            }
            return "Data berhasil disimpan.";
        }
    }
?>
