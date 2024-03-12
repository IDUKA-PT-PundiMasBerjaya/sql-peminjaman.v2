<?php
    include_once("../../../config/koneksi.php");

    class TambahBukuController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }
        
        public function TambahDataPeminjamanBuku($data) {
            $id_peminjaman = $data['id_peminjaman'];
            $jumlah_array = $data['jumlah_buku']; 
            $id_buku_array = $data['buku_id_buku']; 
        
            if (empty($id_peminjaman) || !is_numeric($id_peminjaman)) {
                return "Gagal menyimpan data, Peminjaman ID tidak valid.";
            }
        
            foreach ($id_buku_array as $key => $buku_id_buku) {
                $jumlah = $jumlah_array[$key];
        
                if (!is_numeric($jumlah)) {
                    return "Gagal menyimpan data, Jumlah bukan bilangan.";
                }
        
                $stokBuku = $this->cekStokBuku($buku_id_buku, $jumlah);
                if ($stokBuku === false) {
                    return "Stok barang tidak mencukupi.";
                }
        
                $insertData = mysqli_query($this->kon, "INSERT INTO peminjaman_buku (id_peminjaman, jumlah_buku, buku_id_buku)
                                                        VALUES ('$id_peminjaman', '$jumlah', '$buku_id_buku')");
        
                if (!$insertData) {
                    return "Gagal menyimpan data. Error: " . mysqli_error($this->kon);
                }
            }
            return "Data berhasil disimpan";
        }
        

        private function cekStokBuku ($buku_id_buku, $jumlah) {
            $query = mysqli_query($this->kon, "SELECT stok FROM buku WHERE id_buku = '$buku_id_buku'");
            $data = mysqli_fetch_assoc($query);

            if ($data['stok'] >= $jumlah) {
                return true;
            } else {
                return false;
            }
        }
    }
?>