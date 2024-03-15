<?php 
    include_once("../../../config/koneksi.php");
    include_once("pengembalian_buku.php");

    $pengembalianBukuController = new TambahDataController($kon);

    $dataPengembalian = "SELECT peminjaman.id_peminjaman,
                            CASE
                                WHEN siswa.nama IS NOT NULL THEN siswa.nama
                                WHEN guru.nama IS NOT NULL THEN guru.nama
                            END AS namapeminjaman
                            FROM peminjaman
                            LEFT JOIN siswa ON peminjaman.siswa_idsiswa = siswa.idsiswa
                            LEFT JOIN guru ON peminjaman.guru_idguru = guru.idguru
                            WHERE peminjaman.id_peminjaman NOT IN (SELECT DISTINCT id_pengembalian FROM pengembalian_buku)";
    
    $hasilPengembalian = mysqli_query($kon, $dataPengembalian);

    if (isset($_POST['peminjaman_id_peminjaman'])) {
        $peminjaman_id = $_POST['peminjaman_id_peminjaman'];
        $dataBuku = "SELECT buku.id_buku, buku.judul 
                     FROM peminjaman_buku
                     INNER JOIN buku ON peminjaman_buku.buku_id_buku = buku.id_buku
                     WHERE peminjaman_buku.peminjaman_id_peminjaman = $peminjaman_id";
        $hasilBuku = mysqli_query($kon, $dataBuku);
    } else {
        // Default: Tampilkan semua buku
        $dataBuku = "SELECT id_buku, judul FROM buku";
        $hasilBuku = mysqli_query($kon, $dataBuku);
    }

    if (isset($_POST['submit'])) {
        $data = [
            'peminjaman_id_peminjaman' => (isset($_POST['peminjaman_id_peminjaman'])) ? $_POST['peminjaman_id_peminjaman'] : '',
            'jumlah_buku' => $_POST['jumlah_buku'],
            'tanggal_pengembalian' => $_POST['tanggal_pengembalian'],
            'buku_id_buku' => $_POST['buku_id_buku'],
        ];

        $message = $pengembalianBukuController->TambahDataPengembalianBuku($data);
        header("Location: tambah.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tambah pengembalian Buku</title>
</head>
<body>
<h1>Tambah Data Peminjaman Buku</h1>
    <a href="../../dashboard/data/dspengembalian_buku.php">Home </a>
    <form action="tambah.php" method="post" name="tambahpengembalianbuku" enctype="multipart/form-data" onsubmit="return confirmSubmit()">
        <div class="table-container">
            <table>
                <tr>
                    <th>ID Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                </tr>
                <tr>
                    <td>
                        <select id="peminjaman_id_peminjaman" name="peminjaman_id_peminjaman" style="width: 100%;" onchange="fillTwoInputs()">
                            <?php if (mysqli_num_rows($hasilPengembalian) > 0) : ?>
                                <option value="" disabled selected> Pilih ID Peminjaman </option>
                                    <?php while ($row = mysqli_fetch_assoc($hasilPengembalian)) : ?>
                                        <option value="<?php echo $row['id_peminjaman']; ?>">
                                            <?php echo $row['id_peminjaman'] . ' - ' . $row['namapeminjaman']; ?>
                                        </option>
                                    <?php endwhile; ?>
                            <?php else : ?>
                                <option value="" disabled selected> Tambahkan data peminjaman terlebih dahulu</option>
                            <?php endif; ?>
                        </select>
                    </td>
                    <td><input type="date" name="tanggal_pengembalian" style="width: 100%;"></td>
                </tr>
                <tr>
                    <th>ID Buku</th>
                    <th>Jumlah</th>
                </tr>
                <tr>
                    <td>
                        <select id="buku_id_buku" name="buku_id_buku[]" style="width: 100%;">
                            <?php if (mysqli_num_rows($hasilBuku) > 0) : ?>
                                <option value="" disabled selected>Pilih Buku</option>
                                <?php while ($row = mysqli_fetch_assoc($hasilBuku)) : ?>
                                    <option value="<?php echo $row['id_buku']; ?>">
                                        <?php echo $row['id_buku'] . ' - ' . $row['judul']; ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <option value="" disabled selected> Tambahkan data buku terlebih dahulu.</option>
                            <?php endif; ?>
                        </select>
                    </td>
                    <td><input type="number" name="jumlah_buku[]" style="width: 100%;"></td>
                </tr>
            </table>
        </div>
        <button type="button" class="add-row-button" onclick="addRow()">Tambah Buku</button>
        <input type="submit" name="submit" value="Tambah Data">
    </form>
    <?php if (isset($message) && strpos($message, 'Stok buku tidak mencukupi') !== false): ?>
        <div id="error-message" style="color: red;">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <script>
        function fillTwoInputs() {
            var selectedValue = document.getElementById("peminjaman_id_peminjaman").value;
            document.getElementById("id_pengembalian").value = selectedValue;
        }

        function addRow() {
            var table = document.querySelector('table');
            var lastRow = table.rows[table.rows.length - 1].cloneNode(true);
            var selects = lastRow.getElementsByTagName('select');
            var inputs = lastRow.getElementsByTagName('input');

            // Atur ulang properti name untuk input agar unik
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].value = '';
                inputs[i].name = inputs[i].name.replace(/\[(\d+)\]/g, function(match, p1) {
                    var index = parseInt(p1) + 1;
                    return '[' + index + ']';
                });
            }

            // Hapus nilai dari select
            for (var i = 0; i < selects.length; i++) {
                selects[i].selectedIndex = 0;
            }

            // Hapus tombol hapus jika sudah ada
            var existingDeleteButton = lastRow.querySelector('button');
            if (existingDeleteButton) {
                lastRow.removeChild(existingDeleteButton);
            }

            // Tambahkan tombol Hapus
            var deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.textContent = 'X';
            deleteButton.onclick = function() {
                table.removeChild(lastRow);
            };
            lastRow.appendChild(deleteButton);
            table.appendChild(lastRow);

            // Menghapus pesan kesalahan jika ada
            var existingErrorMessage = document.querySelector('.error-message');
            if (existingErrorMessage) {
                existingErrorMessage.remove();
            }
        }
        //Fungsi menampilkan pesan kesalahan
        function showError(message) {
            var errorMessage = document.createElement('div');
            errorMessage.classList.add('error-message');
            errorMessage.textContent = message;
            errorMessage.style.color = 'red';
            document.body.appendChild(errorMessage);
        }

        function confirmSubmit() {
            var confirmation = confirm('Data yang sudah di simpan tidak bisa di Edit');
            if (confirmation) {
                return true; //Submit Formulir jika menekan OK
            } else {
                return false; // Batalkan jika menekan Cancel
            }
        }
    </script>
</body>
</html>
