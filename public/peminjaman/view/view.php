<?php 
    include_once("../../../config/koneksi.php");
    include_once("viewdata.php");

    $peminjamanController = new PeminjamanController($kon);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data Peminjaman</title>
</head>
<body>
    <a href="../../dashboard/data/dspeminjaman.php">| Home |</a>
    <br><br>
    <form action="view.php" method="post" name="update_data">
        <table>
            <tr>
                <td>ID Peminjaman</td>
                <td>: </td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>Nama Pengguna</td>
                <td>: </td>
                <td><?php echo $namapengguna; ?></td>
            </tr>
            <tr>
                <td>Tanggal Pinjam</td>
                <td>: </td>
                <td><?php echo $tglpinjam; ?></td>
            </tr>
            <tr>
                <td>Tanggal Kemballi</td>
                <td>: </td>
                <td><?php echo $tglkembali; ?></td>
            </tr>
        </table>
    </form>
</body>
</html>