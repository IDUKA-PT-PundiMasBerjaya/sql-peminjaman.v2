<?php 
include_once("../../../config/koneksi.php");
include_once("peminjaman_buku.php");
$peminjamanBukuController = new TambahBukuController($kon);
//Mengambil data peminjaman
$dataPeminjaman = "SELECT peminjaman.id_peminjaman,
                        CASE
                            WHEN siswa.nama IS NOT NULL THEN siswa.nama
                            WHEN guru.nama IS NOT NULL THEN guru.nama
                        END AS namapeminjaman
                        FROM
                        peminjaman
                        LEFT JOIN 
                        siswa ON peminjaman.siswa_idsiswa = siswa.idsiswa
                        LEFT JOIN
                        guru ON peminjaman.guru_idguru = guru.idguru
                      WHERE peminjaman.id_peminjaman NOT IN (SELECT DISTINCT id_peminjaman FROM peminjaman_buku)"; // Menghilangkan ID jika sudah tersimpan
$hasilPeminjaman = mysqli_query($kon, $dataPeminjaman);
//Mengambil data buku untuk opsi dropdown
$dataBuku = "SELECT id_buku, judul FROM buku";
$hasilBuku = mysqli_query($kon, $dataBuku);
//Hasil cek isisan data agar sama dengan Controller
    if (isset($_POST['submit'])) {
        //Menggunakan satu ID Peminjaman untuk semua buku yang ditambahkan
    $data = [
        'id_peminjaman' => (isset($_POST['id_peminjaman'])) ? $_POST['id_peminjaman'] : null,
        'jumlah_buku' => $_POST['jumlah_buku'], // Ini adalah sebuah ARRAY
        'buku_id_buku' => $_POST['buku_id_buku'],
    ];
        //Menambahkan data peminjaman barang
        $message = $peminjamanBukuController->TambahDataPeminjamanBuku($data);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Tambah Peminjaman Buku</title>
</head>
<body>
    <h1>Tambah Data Peminjaman Buku</h1>
    <a href="../../dashboard/data/dspeminjaman_buku.php">Home </a>
    <form action="tambah.php" method="post" name="tambahpeminjamanbuku" enctype="multipart/form-data" onsubmit="return confirmSubmit()">
        <div class="table-container">
            <table>
                <tr> <th colspan="2">ID Peminjaman</th></tr>
                <tr>
                <td>
                    <select id="id_peminjaman" name="id_peminjaman" style="width: 100%;">
                        <?php if (mysqli_num_rows($hasilPeminjaman) > 0) : ?>
                            <option value="" disabled selected> Pilih ID Peminjaman </option>
                                <?php while ($row = mysqli_fetch_assoc($hasilPeminjaman)) : ?>
                                    <option value="<?php echo $row['id_peminjaman']; ?>">
                                        <?php echo $row['id_peminjaman'] . ' - ' . $row['namapeminjaman']; ?>
                                    </option>
                                <?php endwhile; ?>
                        <?php else : ?>
                            <option value="" disabled selected> Tambahkan data peminjaman terlebih dahulu</option>
                        <?php endif; ?>
                    </select>
                </td>
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

    <!-- Tambahkan bagian ini setelah form -->
    <?php if (isset($message) && strpos($message, 'Stok barang tidak mencukupi') !== false): ?>
        <div class="error-message" style="color: red;">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <script>
        function addRow() {
            var table = document.querySelector('table');
            var lastRow = table.rows[table.rows.length - 1].cloneNode(true);
            var selects = lastRow.getElementsByTagName('select');
            var inputs = lastRow.getElementsByTagName('input');

            for (var i = 0; i < selects.length; i++) {
                selects[i].selectedIndex = 0;
            }
            //Membuat baris baru
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].type === 'number') {
                    console.log('Jumlah:', inputs[i].value);
                    inputs[i].value = 0;
                } else {
                    inputs[i].value = '';
                }
            }
            //Hapus tombol hapus jika sudah ada 
            var existingDeleteButton = lastRow.querySelector('button');
            if (existingDeleteButton) {
                lastRow.removeChild(existingDeleteButton);
            }
            //Tambahkan tombol Hapus
            var deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.textContent = 'X';
            deleteButton.onclick = function() {
                table.removeChild(lastRow);
            };
            lastRow.appendChild(deleteButton);
            table.appendChild(lastRow);
            //Menghapus pesan kesalahan jika ada
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