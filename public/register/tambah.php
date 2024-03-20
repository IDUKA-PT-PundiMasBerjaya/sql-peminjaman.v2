<?php 
    include_once("../../config/koneksi.php");
    include_once("tambahakun.php");

    $akunController = new AkunController($kon);

    if (isset($_POST['submit'])) {
        $id = $akunController->tambahAkun();

        $data = [
            'id' => $id,
            'username' => $_POST['username'],
            'password' => $_POST['password'],
        ];

        $message = $akunController->tambahDataAkun($data);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Akun Baru</title>
</head>
<body>
    <h1>Register Akun</h1>
    <form action="tambah.php" method="post" name="tambah" enctype="multipart/form-data">
        <table border="0">
            <tr>
                <td> ID User </td>
                <td>:</td>
                <td><input type="text" name="id" value="<?php echo($akunController->tambahAkun()) ?>" readonly></td>
            </tr>
            <tr>
                <td> Username </td>
                <td>:</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td> Password </td>
                <td>:</td>
                <td><input type="text" name="password"></td>
            </tr>
        </table>
        <p>Sudah Memiliki Akun? <span><a href="../../login.php">Login</a></span></p>
        <input type="submit" name="submit" value="tambah Data">
        <?php if (isset($message)): ?>
            <div class="success-message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>