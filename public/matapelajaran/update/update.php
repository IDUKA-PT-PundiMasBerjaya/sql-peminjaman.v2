<?php 
    include_once("../../../config/koneksi.php");
    include_once("mapelupdate.php");

    $mapelController = new MapelController($kon);

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $namapelajaran = $_POST['namapelajaran'];
        $idguru = $_POST['idguru'];

        $message = $mapelController->updateMapel($id, $namapelajaran, $idguru);
        echo $message;

        header("Location: ../../dashboard/data/dsmatapelajaran.php");
    }

    $id = null;
    $namapelajaran = null;
    $namaguru = null;

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $result = $mapelController->getDataMapel($id);

        if ($result) {
            $id = $result['idpelajaran'];
            $namapelajaran = $result['namapelajaran'];
            $idguru = $result['guru_idguru'];
        } else {
            echo "ID Tidak Valid";
        }
    }

    $dataGuru = "SELECT idguru, nama FROM guru";
    $hasilGuru = mysqli_query($kon, $dataGuru); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Mata Pelajaran</title>
</head>
<body>
    <h1>Update Data Mata Pelajaran</h1>
    <a href="../../dashboard/data/dsmatapelajaran.php">Home</a>
    <form action="update.php" method="POST", name="update" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>ID</td>
                <td><input type="text" name="id" value="<?php echo $id; ?>" readonly></td>
            </tr>
            <tr>
                <td>Mata Pelajaran</td>
                <td><input type="text" name="namapelajaran" value="<?php echo $namapelajaran; ?>"></td>
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
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>