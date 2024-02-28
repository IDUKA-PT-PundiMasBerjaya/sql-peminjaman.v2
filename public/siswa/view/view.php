<?php 
    include_once("../../../config/koneksi.php");
    include_once("viewdata.php");

    $siswaController = new SiswaController($kon);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Data</title>
</head>
<body>
    <a href="../../dashboard/data/dssiswa.php">Home</a>
    <br><br>
    <form action="view.php" name="update_data" method="post">
        <table border="0">
            <tr>
                <td>ID Siswa</td>
                <th>: </th>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>Nama Siswa</td>
                <td>: </td>
                <td><?php echo $nama; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: </td>
                <td><?php echo $alamat; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: </td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td>: </td>
                <td><?php echo $no_hp; ?></td>
            </tr>
            <tr>
                <td>ID User</td>
                <td>: </td>
                <td><?php echo $users_id; ?></td>
            </tr>
        </table>
    </form>
</body>
</html>