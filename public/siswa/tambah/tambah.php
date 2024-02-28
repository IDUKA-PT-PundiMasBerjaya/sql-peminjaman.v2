<?php 
    include_once("../../../config/koneksi.php");
    include_once("siswatambah.php");

    $siswaController = new SiswaController($kon);

    if (isset($_POST['submit'])) {
        $idsiswa = $siswaController->tambahSiswa();

        $data = [
            'idsiswa' => $idsiswa,
            'nama' => $_POST['nama'],
            'alamat' => $_POST['alamat'],
            'email' => $_POST['email'],
            'no_hp' => $_POST['no_hp'],
            'users_id' => $_POST['users_id'],
        ];

        $message = $siswaController->tambahDataSiswa($data);
    }

    $dataUser = "SELECT id, username FROM users";
    $hasilUser = mysqli_query($kon, $dataUser);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tambah Data Siswa</title>
</head>
<body>
    <h1>Tambah Data Siswa</h1>
    <a href="../../dashboard/data/dssiswa.php">Home</a>
    <form action="tambah.php" method="post" name="tambah" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td> ID </td>
                <td><input type="text" name="idsiswa" value="<?php echo($siswaController->tambahSiswa())?>" readonly"></td>
            </tr>
            <tr>
                <td> Nama Siswa </td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td> Alamat </td>
                <td><input type="text" name="alamat" required></td>
            </tr>
            <tr>
                <td> Email </td>
                <td><input type="text" name="email" required></td>
            </tr>
            <tr>
                <td> No. HP </td>
                <td><input type="text" name="no_hp" required></td>
            </tr>
            <tr>
                <td> ID User </td>
                <td>
                    <select name="users_id" id="users_id">
                        <?php while ($row = mysqli_fetch_assoc($hasilUser)) : ?>
                            <option value="<?php echo $row['id']; ?>">
                                <?php echo $row['id'] . ' - ' . $row['username']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Tambah Data">
        <?php if (isset($message)): ?>
            <div class="success-message">
                <?php echo $message;?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>