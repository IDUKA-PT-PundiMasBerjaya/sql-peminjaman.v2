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

                $insertData = mysqli_query($this->kon, "INSERT INTO pengembalian_buku(id_pengembalian, jumlah_buku, tanggal_pengembalian, buku_id_buku, peminjaman_id_peminjaman)
                                                        VALUES ('$id_peminjaman', '$jumlah', '$tanggal_pengembalian', '$buku_id_buku', '$id_peminjaman')");

                if (!$insertData) {
                    return "Gagal menyimpan data. Error : " . mysqli_error($this->kon);
                }
            }
            return "Data berhasil disimpan.";
        }
    }
?>
