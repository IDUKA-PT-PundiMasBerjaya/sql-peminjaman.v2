<?php 
    include_once("../../../config/koneksi.php");
    include_once("kelastambah.php");

    $kelasController = new KelasController($kon);

    if (isset($_POST['submit'])) {
        $idkelas = $kelasController->tambahKelas();

        $data = [
            'id_kelas' => $idkelas,
            'namakelas' => $_POST['namakelas'],
            'kursi' => $_POST['kursi'],
            'meja' => $_POST['meja'],
            'guru_idguru' => $_POST['idguru'],
            'siswa_idsiswa' => $_POST['idsiswa'],
        ];

        $message = $kelasController->tambahDataKelas($data);
    }

    $dataSiswa = "SELECT idsiswa, nama FROM siswa";
    $hasilSiswa = mysqli_query($kon, $dataSiswa);

    $dataGuru = "SELECT idguru, nama FROM guru";
    $hasilGuru = mysqli_query($kon, $dataGuru);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Data Kelas</title>
</head>
<body>
    <h1>Tambah Data Kelas</h1>
    <a href="../../dashboard/data/dskelas.php">Home</a>
    <form action="tambah.php" method="POST" name="tambah" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>ID Kelas</td>
                <td><input type="text" name="idkelas" value="<?php echo($kelasController->tambahKelas())?>" readonly"></td>
            </tr>
            <tr>
                <td>Nama Kelas</td>
                <td><input type="text" name="namakelas" required></td>
            </tr>
            <tr>
                <td>Kursi</td>
                <td><input type="text" name="kursi" required></td>
            </tr>
            <tr>
                <td>Meja</td>
                <td><input type="text" name="meja" required></td>
            </tr>
            <tr>
                <td>Ketua Kelas</td>
                <td>
                    <select id="idsiswa" name="idsiswa">
				        <?php while ($row = mysqli_fetch_assoc($hasilSiswa)) : ?>
					        <option value="<?php echo $row['idsiswa']; ?>">
						        <?php echo $row['idsiswa'] . ' - ' . $row['nama']; ?>
					        </option>
				        <?php endwhile; ?>
			        </select>
                </td>
            </tr>
            <tr>
                <td>Wali Kelas</td>
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
            <tr>
                <td>Gambar Kelas</td>
                <td><input type="file" name="gambar_kelas" required></td>
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