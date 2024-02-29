<?php 
    include_once("../../../config/koneksi.php");
    include_once("viewdata.php");

    $kelasController = new KelasController($kon);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data Kelas</title>
</head>
<body>
    <a href="../../dashboard/data/dskelas.php">Home</a>
    <br><br>
    <form name="update_data" method="post" action="view.php">
        <table border="0">
            <tr>
                <td>ID Kelas</td>
                <td>: </td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>Nama Kelas</td>
                <td>: </td>
                <td><?php echo $namakelas; ?></td>
            </tr>
            <tr>
                <td>Kursi</td>
                <td>: </td>
                <td><?php echo $kursi; ?></td>
            </tr>
            <tr>
                <td>Meja</td>
                <td>: </td>
                <td><?php echo $meja; ?></td>
            </tr>
            <tr>
                <td>ID Guru</td>
                <td>: </td>
                <td><?php echo $idguru; ?></td>
            </tr>
            <tr>
                <td>ID Siswa</td>
                <td>: </td>
                <td><?php echo $idsiswa; ?></td>
            </tr>
            <tr>
                <td>Gambar Kelas</td>
                <td>: </td>
                <td>
                    <?php 
                    $data = mysqli_query($kon, "SELECT * FROM kelas WHERE id_kelas = $id");
                    while ($row = mysqli_fetch_array($data)) :
                    ?>
                        <a href="#" onclick="window.open('../aset/<?php echo $row['gambar_kelas']; ?>', '_blank');"></a>
                        <img src="../aset/<?php echo $row['gambar_kelas']; ?>" alt="<?php echo $row['gambar_kelas']; ?>" width="240" height="160">
                    <?php endwhile; ?>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>