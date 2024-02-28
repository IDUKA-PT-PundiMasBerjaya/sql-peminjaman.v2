<?php 
    include_once("../../../config/koneksi.php");
    include_once("viewdata.php");

    $bukuController = new BukuController($kon);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data Buku</title>
</head>
<body>
    <a href="../../dashboard/data/dsperpustakaan.php">| Home |</a>
    <br><br>
    <form name="update_data" method="post" action="view.php">
        <table>
            <tr>
                <td>No</td>
                <td>: </td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>Judul</td>
                <td>: </td>
                <td><?php echo $judul; ?></td>
            </tr>
            <tr>
                <td>Penulis</td>
                <td>: </td>
                <td><?php echo $penulis; ?></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>: </td>
                <td><?php echo $keterangan; ?></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td>: </td>
                <td><?php echo $stok; ?></td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td>: </td>
                <td><?php echo $gambar; ?></td>
            </tr>
            <tr>
                <td>Mata Pelajaran</td>
                <td>: </td>
                <td><?php echo $mata_pelajaran ?></td>
            </tr>
        </table>
    </form>
</body>
</html>