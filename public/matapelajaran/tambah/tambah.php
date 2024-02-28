<?php 
    include_once("../../../config/koneksi.php");
    include_once("mapeltambah.php");

    $mapelController = new MapelController($kon);

    if (isset($_POST['submit'])) {
        $idpelajaran = $mapelController->tambahMapel();
        
        $data = [
            'idpelajaran' => $idpelajaran,
            'namapelajaran' => $_POST['namapelajaran'],
            'guru_idguru' => $_POST['idguru'],
        ];

        $message = $mapelController->tambahDataMapel($data);
    }

    $dataGuru = "SELECT idguru, nama FROM guru";
    $hasilGuru = mysqli_query($kon, $dataGuru); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mata Pelajaran</title>
</head>
<body>
    <h1>Tambah Data Guru</h1>
    <a href="../../dashboard/data/dsmatapelajaran.php">Home</a>
    <form action="tambah.php" method="POST" name="tambah" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>No ID</td>
                <td><input type="text" name="id" value="<?php echo($mapelController->tambahMapel())?>" readonly></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="namapelajaran" required></td>
            </tr>
            <tr>
                <td>ID Guru</td>
                <td>   
                    <select id="idguru" name="idguru">
				        <?php while ($row = mysqli_fetch_assoc($hasilGuru)) : ?>
					        <option value="<?php echo $row['idguru']; ?>">
						        <?php echo $row['idguru'] . ' - ' . $row['nama']; ?>
					        </option>
				        <?php endwhile; ?>
			        </select>
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Tambah Data">
        <?php if (isset($message)): ?>
            <div class="success-message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>