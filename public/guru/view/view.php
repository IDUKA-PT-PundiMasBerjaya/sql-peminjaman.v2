<?php 
    include_once("../../../config/koneksi.php");
    include_once("viewdata.php");

    $guruController = new GuruController($kon);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data Guru</title>
</head>
<body>
    <a href="../../dashboard/data/dsguru.php">| Home |</a>
    <br><br>
    <form name="update_data" action="view.php" method="post">
        <table border="0">
            <tr>
                <td>ID Guru</td>
                <td>: </td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>Nama Guru</td>
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
        </table>
    </form>
</body>
</html>