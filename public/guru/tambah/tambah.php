<?php 
    include_once("../../../config/koneksi.php");
    include_once("gurutambah.php");

    $guruController = new GuruController($kon);

    if (isset($_POST['submit'])) {
        $idguru = $guruController->tambahGuru();
        
        $data = [
            'idguru' => $idguru,
            'nama' => $_POST['nama'],
            'alamat' => $_POST['alamat'],
            'email' => $_POST['email'],
            'no_hp' => $_POST['no_hp'],
        ];

        $message = $guruController->tambahDataGuru($data);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Guru</title>
</head>
<body>
    <h1>Tambah Data Guru</h1>
    <a href="../../dashboard/data/dsguru.php">Home</a>
    <form action="tambah.php" method="POST" name="tambah" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>No ID</td>
                <td><input type="text" name="idsiswa" value="<?php echo($guruController->tambahGuru())?>" readonly></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" required></td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td><input type="text" name="no_hp" required></td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Tambah Data">
        <?php if (isset($message)): ?>
            <div class="success-message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>