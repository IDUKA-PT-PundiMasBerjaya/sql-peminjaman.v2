<?php 
    include_once("../../config/koneksi.php");
    
    class AkunController {
        private $kon;

        public function __construct($connection){
            $this->kon = $connection;
        }

        public function tambahAkun() {
            $setAuto = mysqli_query($this->kon, "SELECT MAX(id) AS max_id FROM users");
            $result = mysqli_fetch_assoc($setAuto);
            $max_id = $result['max_id'];

            if (is_numeric($max_id)) {
                $nounik = $max_id + 1;
            } else {
                $nounik = 1;
            } return $nounik;
        }

        public function tambahDataAkun($data) {
            $id = $data['id'];
            $username = $data['username'];
            $password = $data['password'];

            $insertData = mysqli_query($this->kon, "INSERT INTO users(id, username, password) VALUES('$id', '$username', '$password')");
            
            if ($insertData) {
                return "Data berhasil disimpan ";
            } else {
                return "gagal menyimpan data ";
            }
        }
    }
?>