<?php
    include_once("../../config/koneksi.php");
    require("../../library/fpdf.php");

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

    $pdf->SetFont('Times', 'B', 13);
    $pdf->Cell(0, 15, '', 0, 1);
    $pdf->Cell(250, 10, 'Data Guru', 0, 0, 'R');

    $pdf->Cell(10, 17, '', 0, 1);	
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(10, 7, 'No', 1, 0, 'C');
    $pdf->Cell(30, 7, 'ID Peminjaman', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Nama Peminjam', 1, 0, 'C');
    $pdf->Cell(110, 7, 'Nama Buku', 1, 0, 'C');
    $pdf->Cell(22, 7, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(22, 7, 'Sisa', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Tgl. Peminjaman', 1, 0, 'C');

    $pdf->Cell(10, 7, '', 0, 1);
    $pdf->SetFont('Times', '', 10);

    $no = 1;
    $data = "SELECT peminjaman_buku.id_peminjaman, buku.judul AS nama_buku,
                CASE
                    WHEN siswa.nama IS NOT NULL THEN siswa.nama
                    WHEN guru.nama IS NOT NULL THEN guru.nama
                END AS namapeminjaman,
                peminjaman_buku.jumlah_buku,
                buku.stok,
                buku.gambar AS gambar_buku,
                peminjaman.tanggal_pinjam
                FROM 
                peminjaman_buku
                JOIN 
                peminjaman ON peminjaman_buku.id_peminjaman = peminjaman.id_peminjaman                
                LEFT JOIN
                siswa ON peminjaman.siswa_idsiswa = siswa.idsiswa
                LEFT JOIN 
                guru ON peminjaman.guru_idguru = guru.idguru
                JOIN 
                buku ON peminjaman_buku.buku_id_buku = buku.id_buku";

    $ambildata = mysqli_query($kon, $data) or die(mysqli_error($kon));
    $num = mysqli_num_rows($ambildata);

    $prevpeminjamanID = null;
    $rowSpanCounts = [];

    if ($num > 0) {
        while ($row = mysqli_fetch_array($ambildata)) {
            $peminjamanID = $row['id_peminjaman'];
            $rowSpanCounts[$peminjamanID][] = $row;
        }

        mysqli_data_seek($ambildata, 0);
        $no = 1;
        foreach ($rowSpanCounts as $peminjamanID => $rows) {
            $rowSpanCount = count($rows);
            $firstRow = true;
            foreach ($rows as $key => $userAmbilData) {
                if ($firstRow) {
                    $pdf->Cell(10, 6 * $rowSpanCount, $no++, 1, 0, 'C');
                $pdf->Cell(30, 6 * $rowSpanCount, $userAmbilData['id_peminjaman'], 1, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, $userAmbilData['namapeminjaman'], 1, 0, 'C');
                    $firstRow = false;
                } else {
                    $pdf->Cell(10, 6 * $rowSpanCount, '', 0, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, '', 0, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, '', 0, 0, 'C');
                }

                $pdf->Cell(110, 6, $userAmbilData['nama_buku'], 1, 0, 'C');
                $pdf->Cell(22, 6, $userAmbilData['jumlah_buku'], 1, 0, 'C');
                $pdf->Cell(22, 6, $userAmbilData['stok'], 1, 0, 'C');
                $pdf->Cell(30, 6, $userAmbilData['tanggal_pinjam'], 1, 1, 'C');
            }
        }
    }

    $pdf->Output();
?>