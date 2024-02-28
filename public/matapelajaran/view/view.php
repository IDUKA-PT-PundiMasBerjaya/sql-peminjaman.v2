<?php 
    include_once("../../../config/koneksi.php");
    include_once("viewdata.php");

    $mapelController = new MapelController($kon);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Mata Pelajaran</title>
</head>
<body>
    <a href="../../dashboard/data/dsmatapelajaran.php"> Home </a>
    <br><br>
    <form action="view.php" name="update_data" method="post">
        <table border="0">
            <tr>
                <td>ID Pelajaran</td>
                <td>: </td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>Mata Pelajaran</td>
                <td>: </td>
                <td><?php echo $namapelajaran; ?></td>
            </tr>
            <tr>
                <td>ID Guru</td>
                <td>: </td>
                <td><?php echo $idguru; ?></td>
            </tr>
        </table>
    </form>
</body>
</html>