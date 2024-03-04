<?php 
    include_once("../../../config/koneksi.php");
    include_once("peminjamantambah.php");

    $peminjamanController = new PeminjamanController($kon);
    if (isset($_POST['submit'])) {
        if ($_POST['role'] === 'guru_idguru' && isset($_POST['guru_idguru']) && !empty($_POST['guru_idguru']) && !isset($_POST['siswa_id'])) {
            $idpeminjaman = $peminjamanController->tambahPeminjaman();
            $data = [
                'id_peminjaman' => $idpeminjaman,
                'tanggal_pinjam' => $_POST['tanggal_pinjam'],
                'tanggal_kembali' => $_POST['tanggal_kembali'],
                'guru_idguru' => $_POST['guru_idguru'],
                'siswa_idsiswa' => null,
            ];
            $message = $peminjamanController->tambahDataPeminjaman($data);
        } else if ($_POST['role'] === 'siswa_idsiswa' && isset($_POST['siswa_idsiswa']) && !empty($_POST['siswa_idsiswa']) && !isset($_POST['guru_id'])) {
            $idpeminjaman = $peminjamanController->tambahPeminjaman();
            $data = [
                'id_peminjaman' => $idpeminjaman,
                'tanggal_pinjam' => $_POST['tanggal_pinjam'],
                'tanggal_kembali' => $_POST['tanggal_kembali'],
                'guru_idguru' => null,
                'siswa_idsiswa' => $_POST['siswa_idsiswa'],
            ];
            $message = $peminjamanController->tambahDataPeminjaman($data);
        } else {
            $message = "Harap pilih salah satu antara ID guru atau ID siswa control";
        }
    }

    $dataSiswa = mysqli_query($kon, "SELECT idsiswa, nama FROM siswa");
    $dataGuru = mysqli_query($kon, "SELECT idguru, nama FROM guru");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Peminjaman</title>
    <script>
        function showOptions(role) {
            var guruOptions = document.getElementById('guruOptions');
            var siswaOptions = document.getElementById('siswaOptions');

            if (role === 'guru') {
                guruOptions.style.display = 'block';
                siswaOptions.style.display = 'none';
            } else if (role === 'siswa') {
                guruOptions.style.display = 'none';
                siswaOptions.style.display = 'block';
            }
        }
    </script>
</head>
<body>
    <h1>Tambah Data Peminjaman</h1>
    <a href="../../dashboard/data/dspeminjaman.php">Home</a>
    <form action="tambah.php" method="post" name="tambah" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>ID Peminjaman</td>
                <td><input type="text" name="idpeminjaman" value="<?php echo($peminjamanController->tambahPeminjaman())?>" readonly"></td>
            </tr>
            <tr>
                <td>Pilih</td>
                <td>
                    <input type="radio" name="role" value="guru_idguru" id="guru_idguru" onclick="showOptions('guru')">
                    <label for="guru_idguru">Guru</label>
                    <input type="radio" name="role" value="siswa_idsiswa" id="siswa_idsiswa" onclick="showOptions('siswa')">
                    <label for="siswa_idsiswa">Siswa</label>
                </td>
            </tr>
            <tr id="guruOptions" style="display: none;">
                <td>Data Guru</td>
                <td>
                    <select name="guru_idguru">
                        <?php while($row = mysqli_fetch_assoc($dataGuru)) : ?>
                            <option value="<?php echo $row['idguru']; ?>">
                                <?php echo $row['idguru'] . ' - ' . $row['nama']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr id="siswaOptions" style="display: none;">
                <td>Data Siswa</td>
                <td>
                    <select name="siswa_idsiswa">
                        <?php while($row = mysqli_fetch_assoc($dataSiswa)) : ?>
                            <option value="<?php echo $row['idsiswa']; ?>">
                                <?php echo $row['idsiswa'] . ' - ' . $row['nama']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Tanggal Pinjam</td>
                <td><input type="date" name="tanggal_pinjam" required></td>
            </tr>
            <tr>
                <td>Tanggal Kembali</td>
                <td><input type="date" name="tanggal_kembali" required></td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Tambah Data">
        <?php  if (isset($message)) : ?>
            <div class="success-message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>