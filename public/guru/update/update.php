<?php 
    include_once("../../../config/koneksi.php");
    include_once("guruupdate.php");

    $guruController = new GuruController($kon);

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $no_hp = $_POST['no_hp'];

        $message = $guruController->updateGuru($id, $nama, $alamat, $email, $no_hp);
        echo $message;

        header("Location: ../../dashboard/data/dsguru.php");
    }

    $id = null;
    $nama = null;
    $alamat = null;
    $email = null;
    $no_hp = null;

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $result = $guruController->getDataGuru($id);

        if ($result) {
            $id = $result['idguru'];
            $nama = $result['nama'];
            $alamat = $result['alamat'];
            $email = $result['email'];
            $no_hp = $result['no_hp'];
        } else {
            echo "ID Tidak Valid";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Guru</title>
</head>
<body>
    <h1>Update Data Guru</h1>
    <a href="../../dashboard/data/dsguru.php">Home</a>
    <form action="update.php" method="POST" name="update" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>No ID</td>
                <td><input type="text" name="id" value="<?php echo $id; ?>" readonly></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $nama; ?>" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?php echo $alamat; ?>" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email; ?>" required></td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td><input type="text" name="no_hp" value="<?php echo $no_hp; ?>" required></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>