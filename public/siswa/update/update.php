<?php 
    include_once("../../../config/koneksi.php");
    include_once("siswaupdate.php");

    $siswaController = new SiswaController($kon);

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $no_hp = $_POST['no_hp'];
        $users_id = $_POST['users_id'];

        $message = $siswaController->updateSiswa($id, $nama, $alamat, $email, $no_hp, $users_id);
        echo $message;

        header("Location: ../../dashboard/data/dssiswa.php");
    }

    $id = null;
    $nama = null;
    $alamat = null;
    $email = null;
    $no_hp = null;
    $users_id = null;

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $result = $siswaController->GetDataSiswa($id);

        if ($result) {
            $id = $result['idsiswa'];
            $nama = $result['nama'];
            $alamat = $result['alamat'];
            $email = $result['email'];
            $no_hp = $result['no_hp'];
            $users_id = $result['users_id'];
        } else {
            echo "ID Tidak Valid";
        }
    }

    $dataUser = "SELECT id, username FROM users";
    $hasilUser = mysqli_query($kon, $dataUser); 
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
    <a href="../../dashboard/data/dssiswa.php">Home</a>
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
                <td>ID User</td>
                <td>
                    <select id="users_id" name="users_id">
                        <?php while ($row = mysqli_fetch_assoc($hasilUser)) : ?>
                            <option value="<?php echo $row['id']; ?>">
                                <?php echo $row['id'] . ' - ' . $row['username']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>
